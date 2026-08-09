CREATE DATABASE IF NOT EXISTS clinic_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE clinic_system;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL,
  email VARCHAR(160) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('administrator','doctor','receptionist','patient') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE departments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(120) NOT NULL UNIQUE,
  description TEXT
);

CREATE TABLE patients (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NULL,
  fullname VARCHAR(160) NOT NULL,
  gender VARCHAR(30) NOT NULL,
  dob DATE NOT NULL,
  phone VARCHAR(50) NOT NULL,
  address TEXT NOT NULL,
  blood_group VARCHAR(10),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE doctors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  department_id INT NOT NULL,
  specialization VARCHAR(160) NOT NULL,
  consultation_fee DECIMAL(10,2) NOT NULL DEFAULT 0,
  availability VARCHAR(255),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (department_id) REFERENCES departments(id)
);

CREATE TABLE appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  patient_id INT NOT NULL,
  doctor_id INT NOT NULL,
  appointment_date DATE NOT NULL,
  appointment_time TIME NOT NULL,
  status ENUM('Pending','Approved','Completed','Cancelled','Missed') NOT NULL DEFAULT 'Pending',
  reason TEXT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
  FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
  INDEX appointment_lookup (doctor_id, appointment_date, appointment_time)
);

CREATE TABLE medical_records (
  id INT AUTO_INCREMENT PRIMARY KEY,
  appointment_id INT NOT NULL,
  diagnosis TEXT,
  symptoms TEXT,
  blood_pressure VARCHAR(30),
  weight DECIMAL(5,2),
  height DECIMAL(5,2),
  temperature DECIMAL(4,1),
  treatment TEXT,
  notes TEXT,
  laboratory_requests TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (appointment_id) REFERENCES appointments(id) ON DELETE CASCADE
);

CREATE TABLE prescriptions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  medical_record_id INT NOT NULL,
  medicine VARCHAR(160) NOT NULL,
  dosage VARCHAR(120) NOT NULL,
  duration VARCHAR(120) NOT NULL,
  instructions TEXT,
  FOREIGN KEY (medical_record_id) REFERENCES medical_records(id) ON DELETE CASCADE
);

CREATE TABLE staff (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(160) NOT NULL,
  position VARCHAR(120) NOT NULL,
  phone VARCHAR(50) NOT NULL
);

CREATE TABLE clinic_schedule (
  id INT AUTO_INCREMENT PRIMARY KEY,
  doctor_id INT NOT NULL,
  day VARCHAR(20) NOT NULL,
  start_time TIME NOT NULL,
  end_time TIME NOT NULL,
  FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE
);

INSERT INTO departments (name, description) VALUES
('General Medicine','Primary care and general consultations'),('Pediatrics','Child wellness and immunizations'),('Dental','Dental checkups and procedures'),('Eye Clinic','Vision screening and ophthalmology'),('Laboratory','Diagnostics and lab requests'),('Pharmacy','Medicine dispensing and counseling');

INSERT INTO users (name,email,password,role) VALUES
('System Administrator','admin@clinic.test','$2y$12$ajGSExoATp8/4ExWB2XQye6LxVSjr/BFpn2B/KeH/Q6hV.q4DZ8R2','administrator'),
('Dr. Ada Okafor','doctor@clinic.test','$2y$12$ajGSExoATp8/4ExWB2XQye6LxVSjr/BFpn2B/KeH/Q6hV.q4DZ8R2','doctor'),
('Grace Reception','reception@clinic.test','$2y$12$ajGSExoATp8/4ExWB2XQye6LxVSjr/BFpn2B/KeH/Q6hV.q4DZ8R2','receptionist'),
('John Patient','patient@clinic.test','$2y$12$ajGSExoATp8/4ExWB2XQye6LxVSjr/BFpn2B/KeH/Q6hV.q4DZ8R2','patient');

INSERT INTO patients (user_id, fullname, gender, dob, phone, address, blood_group) VALUES (4,'John Patient','Male','1990-01-15','555-0100','123 Clinic Road','O+');
INSERT INTO doctors (user_id, department_id, specialization, consultation_fee, availability) VALUES (2,1,'Family Medicine',75.00,'Mon-Fri 09:00-17:00');
INSERT INTO appointments (patient_id, doctor_id, appointment_date, appointment_time, status, reason) VALUES (1,1,CURDATE(),'10:30:00','Pending','Routine checkup');
INSERT INTO staff (name, position, phone) VALUES ('Grace Reception','Receptionist','555-0120');
INSERT INTO clinic_schedule (doctor_id, day, start_time, end_time) VALUES (1,'Monday','09:00:00','17:00:00'),(1,'Tuesday','09:00:00','17:00:00');
