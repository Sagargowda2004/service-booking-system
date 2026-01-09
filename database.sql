-- ===============================
-- Database: service_booking
-- ===============================

CREATE DATABASE IF NOT EXISTS service_booking;
USE service_booking;

-- ===============================
-- Table: service_providers
-- ===============================
CREATE TABLE service_providers (
    provider_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    service_type VARCHAR(50) NOT NULL,
    location VARCHAR(50) NOT NULL,
    active TINYINT DEFAULT 1
);

-- ===============================
-- Table: provider_availability
-- ===============================
CREATE TABLE provider_availability (
    availability_id INT AUTO_INCREMENT PRIMARY KEY,
    provider_id INT NOT NULL,
    day_of_week INT NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    FOREIGN KEY (provider_id)
        REFERENCES service_providers(provider_id)
        ON DELETE RESTRICT
);

-- ===============================
-- Table: service_requests
-- ===============================
CREATE TABLE service_requests (
    request_id INT AUTO_INCREMENT PRIMARY KEY,
    service_type VARCHAR(50) NOT NULL,
    requested_date DATE NOT NULL,
    time_window VARCHAR(20) NOT NULL,
    customer_location VARCHAR(50) NOT NULL,
    status VARCHAR(20) DEFAULT 'open'
);

-- ===============================
-- Table: assignments
-- ===============================
CREATE TABLE assignments (
    assignment_id INT AUTO_INCREMENT PRIMARY KEY,
    request_id INT NOT NULL,
    provider_id INT NOT NULL,
    FOREIGN KEY (request_id)
        REFERENCES service_requests(request_id)
        ON DELETE RESTRICT,
    FOREIGN KEY (provider_id)
        REFERENCES service_providers(provider_id)
        ON DELETE RESTRICT
);

-- ===============================
-- OPTIONAL SAMPLE DATA (SAFE)
-- ===============================

INSERT INTO service_providers (name, service_type, location, active)
VALUES ('Demo Provider', 'Plumber', 'Mysore', 1);
