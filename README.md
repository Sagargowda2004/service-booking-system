
---

## 🗄️ Database Setup
The project includes a `database.sql` file which creates all required tables and relationships.

### Steps:
1. Open **phpMyAdmin**
2. Click **Import**
3. Select `database.sql`
4. Click **Go**

---

## 🚀 How to Run the Project
1. Install **XAMPP**
2. Start **Apache** and **MySQL**
3. Import `database.sql` into phpMyAdmin
4. Configure database credentials in `config/db.php`
5. Open the browser and navigate to:

http://localhost/SERVICE_BOOKING/auth/login.php



---

## 🔐 Authentication Flow
- All users log in through a central login page.
- Session-based role management is used.
- Providers can register through the login page.
- Logout clears the session and redirects to login.

---

## 🔄 Job Lifecycle Flow

open → assigned → confirmed → closed



---

## 📝 Notes
- No external dependencies are required.
- Bootstrap is loaded via CDN.
- Database integrity is maintained using foreign key constraints.
- Providers are marked inactive instead of deleted to preserve history.

---

## 👤 Author
**Sagar H N**

---

## 📌 Submission Notes
- Complete source code included
- Database schema provided
- System design diagrams included
- Project is fully runnable on a fresh setup

