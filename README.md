# YJ Creating – ระบบหลังบ้าน (Back-End System)

## 🎯 ภาพรวมระบบ
ระบบนี้ใช้สำหรับ **จัดการข้อมูลคอร์สและกิจกรรม (Course & Event)** โดยแยกสิทธิ์การใช้งานออกเป็น 2 บทบาทหลัก:

- **Admin (พนักงาน):** ทำหน้าที่เพิ่ม/แก้ไข/ลบข้อมูลคอร์สหรือกิจกรรม
- **Owner (เจ้าของบริษัท):** ทำหน้าที่ตรวจสอบ อนุมัติ หรือไม่อนุมัติเนื้อหาที่ Admin เพิ่มเข้ามา

ข้อมูลทั้งหมดถูกเก็บในฐานข้อมูล MySQL โดยมีการบันทึกประวัติ (History) และการอนุมัติ (Approval History) ทุกครั้ง

---

## 🗂 ตารางในฐานข้อมูล

### 1. `course`
เก็บข้อมูลคอร์สเรียน
- CourseID (PK)
- CourseName, Category, Description, Duration, Fee, Teacher, Image
- status: `pending`, `approved`, `disapproved`

### 2. `event`
เก็บข้อมูลกิจกรรม
- EventID (PK)
- E_Title, E_Detail, E_StartDate, E_EndDate, E_Location, E_Image
- status: `pending`, `approved`, `disapproved`

### 3. `approval_history`
เก็บประวัติการอนุมัติ
- id (PK)
- item_type: `course` หรือ `event`
- item_id: อ้างถึง CourseID หรือ EventID
- status: `pending`, `approved`, `disapproved`
- reason: เหตุผลในการไม่อนุมัติ
- created_at: เวลาอนุมัติ

### 4. `history`
เก็บการกระทำ (log)
- id (PK)
- item_type: `course` หรือ `event`
- item_id: อ้างถึง CourseID หรือ EventID
- action: `approved` หรือ `disapproved`
- reason
- owner: ใครเป็นคนกระทำ
- created_at: วันเวลา

---

## 🔗 ความสัมพันธ์ (Relationship)
- course (1) → approval_history (M)
- event (1) → approval_history (M)
- course (1) → history (M)
- event (1) → history (M)

---

## ⚙️ การทำงาน (Flow)

### 1. Admin (พนักงาน)
- Login → Admin Dashboard
- เพิ่ม/แก้ไข/ลบ Course และ Event
- เมื่อเพิ่มข้อมูลใหม่ → `status = pending`
- งานที่ใส่เข้ามาจะยังไม่ขึ้นหน้าเว็บสาธารณะ

### 2. Owner (เจ้าของบริษัท)
- Login → Owner Dashboard
- เห็นรายการที่ `status = pending`
- สามารถกด **Approve** หรือ **Disapprove**
- ถ้า approve → รายการนั้นจะ `status = approved` และถูกแสดงบนหน้าเว็บ
- ถ้า disapprove → ต้องใส่เหตุผล, รายการนั้นจะไม่แสดงบนหน้าเว็บ

### 3. ประวัติการทำงาน
- ทุกการอนุมัติ/ไม่อนุมัติ ถูกบันทึกไว้ใน `approval_history` และ `history`
- Admin/Owner สามารถเปิดดูย้อนหลังได้

---

## 🖥 หน้าจอหลักของระบบ

### Admin Dashboard
- จัดการหน้า Home
- จัดการ Course
- จัดการ Event
- ดูประวัติ (History)
- ปุ่มออกจากระบบ

### Owner Dashboard
- ตรวจสอบ Course
- ตรวจสอบ Event
- ดูประวัติ
- ปุ่มออกจากระบบ

---

## 📊 สรุปให้เข้าใจง่าย
- **Admin = พนักงาน** → ทำหน้าที่ “ใส่งานเข้าระบบ”
- **Owner = เจ้านาย** → ทำหน้าที่ “ตรวจงาน กดอนุมัติ/ไม่อนุมัติ”
- **History/Approval History = สมุดบันทึก** → จดไว้ทุกครั้งว่าใครทำอะไร

---

## 🔐 สิทธิ์การเข้าถึง
- `/admin/*` → ต้องล็อกอินเป็น Admin
- `/owner/*` → ต้องล็อกอินเป็น Owner
- หน้าเว็บสาธารณะ (`index.php`, `course.php`, ...) → แสดงเฉพาะข้อมูลที่ `status='approved'`

---

## 🚀 การใช้งานจริง
1. Admin ใส่คอร์สใหม่ → pending
2. Owner ตรวจงาน → กด Approve หรือ Disapprove
3. ถ้า Approve → คอร์ส/กิจกรรมโชว์บนหน้าเว็บจริง
4. ทุกการกระทำถูกบันทึกใน History


=============================================================
                    วิธีโหลดไปใช้
=============================================================

1) โหลด
2) แตกไฟล์
3) แตกไปที่ XAMPP/htdocs
4) ไฟล์ทีคือ YJ folder
5) เปิด VS Code
6) ใน Folder มี website_yj.sql อันนี้คือ back-ends
7) เอาไป import ลง XAMPP
8) create Back-End ที่ชื่อ website_yj ถึงจะใส่โค๊ด sql หรือ import ได้
9) วิธีรัน มี 3 web คือ
9.1) http://localhost/YJ/index.php
9.2) http://localhost/YJ/admin/login.php
9.3) http://localhost/YJ/owner/login.php

10) รหัสของ owner , admin อยู่ในไฟล์ login ทั้งสอง
