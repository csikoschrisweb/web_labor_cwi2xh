-- Adatbázis létrehozása (ha még nincs)
CREATE DATABASE utazasi_iroda;
GO
USE utazasi_iroda;
GO

-- Felhasználók tábla
CREATE TABLE users (
    id INT PRIMARY KEY IDENTITY(1,1),
    name NVARCHAR(255) NOT NULL,
    email NVARCHAR(255) UNIQUE NOT NULL,
    password NVARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT GETDATE()
);
GO

-- Üzenetek tábla
CREATE TABLE messages (
    id INT PRIMARY KEY IDENTITY(1,1),
    name NVARCHAR(255) NOT NULL,
    email NVARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    sent_at DATETIME DEFAULT GETDATE()
);
GO

-- Képfeltöltések tábla
CREATE TABLE images (
    id INT PRIMARY KEY IDENTITY(1,1),
    user_id INT NOT NULL,
    file_name NVARCHAR(255) NOT NULL,
    uploaded_at DATETIME DEFAULT GETDATE(),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
GO

-- Indexek és optimalizálás
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_messages_sent_at ON messages(sent_at);
CREATE INDEX idx_images_uploaded_at ON images(uploaded_at);
GO