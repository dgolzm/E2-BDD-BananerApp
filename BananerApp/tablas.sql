-- Crear una tabla de usuarios
CREATE TABLE users (
    id SERIAL PRIMARY KEY,       -- id será la clave primaria y se auto-incrementará
    name VARCHAR(100) NOT NULL,  -- nombre de usuario, obligatorio
    email VARCHAR(100) UNIQUE NOT NULL,  -- correo único y obligatorio
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP  -- fecha de creación
);

-- Crear una tabla de artículos
CREATE TABLE articles (
    id SERIAL PRIMARY KEY,       -- id del artículo, clave primaria auto-incremental
    user_id INTEGER NOT NULL,    -- id del autor (usuario), referencia a la tabla users
    title VARCHAR(255) NOT NULL, -- título del artículo
    body TEXT,                   -- cuerpo del artículo
    published_at TIMESTAMP,      -- fecha de publicación
    FOREIGN KEY (user_id) REFERENCES users(id)  -- clave foránea hacia users
);
