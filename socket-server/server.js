require('dotenv').config();
const express = require('express');
const http = require('http');
const { Server } = require('socket.io');
const cors = require('cors');

const app = express();
const server = http.createServer(app);

// Configuración de Socket.io con CORS
const io = new Server(server, {
    cors: {
        origin: process.env.ALLOWED_ORIGINS?.split(',') || '*',
        methods: ['GET', 'POST']
    }
});

// Middleware
app.use(cors());
app.use(express.json());

// Almacenar usuarios conectados por ID
const connectedUsers = new Map();

// Manejo de conexiones WebSocket
io.on('connection', (socket) => {
    console.log('✅ Cliente conectado:', socket.id);

    // Autenticar usuario (el cliente envía su ID)
    socket.on('authenticate', (userId) => {
        connectedUsers.set(userId, socket.id);
        socket.userId = userId;
        console.log(`👤 Usuario ${userId} autenticado con socket ${socket.id}`);
    });

    // Unirse a sala de evento específico
    socket.on('join-evento', (eventoId) => {
        const room = `evento-${eventoId}`;
        socket.join(room);
        console.log(`🎯 Socket ${socket.id} se unió a ${room}`);
    });

    // Salir de sala de evento
    socket.on('leave-evento', (eventoId) => {
        const room = `evento-${eventoId}`;
        socket.leave(room);
        console.log(`🚪 Socket ${socket.id} salió de ${room}`);
    });

    // Desconexión
    socket.on('disconnect', () => {
        if (socket.userId) {
            connectedUsers.delete(socket.userId);
            console.log(`❌ Usuario ${socket.userId} desconectado`);
        } else {
            console.log('❌ Cliente desconectado:', socket.id);
        }
    });
});

// Endpoint HTTP para que Laravel envíe eventos
app.post('/broadcast', (req, res) => {
    const { event, data, userId, room } = req.body;

    if (!event) {
        return res.status(400).json({ error: 'El campo "event" es requerido' });
    }

    try {
        if (userId) {
            // Enviar a usuario específico
            const socketId = connectedUsers.get(parseInt(userId));
            if (socketId) {
                io.to(socketId).emit(event, data);
                console.log(`📤 Evento "${event}" enviado a usuario ${userId}`);
            } else {
                console.log(`⚠️ Usuario ${userId} no está conectado`);
            }
        } else if (room) {
            // Enviar a sala específica
            io.to(room).emit(event, data);
            console.log(`📤 Evento "${event}" enviado a sala "${room}"`);
        } else {
            // Broadcast a todos
            io.emit(event, data);
            console.log(`📢 Evento "${event}" enviado a todos los clientes`);
        }

        res.json({
            success: true,
            message: 'Evento emitido correctamente',
            connectedClients: io.engine.clientsCount
        });
    } catch (error) {
        console.error('❌ Error al emitir evento:', error);
        res.status(500).json({ error: 'Error al emitir evento' });
    }
});

// Endpoint de salud
app.get('/health', (req, res) => {
    res.json({
        status: 'ok',
        connectedClients: io.engine.clientsCount,
        uptime: process.uptime()
    });
});

// Iniciar servidor
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
    console.log(`🚀 Servidor WebSocket corriendo en puerto ${PORT}`);
    console.log(`📡 Esperando conexiones...`);
});
