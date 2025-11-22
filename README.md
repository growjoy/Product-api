# 📦 Product API Service – Laravel 12

Project ini adalah implementasi **RESTful API** menggunakan Laravel 12 yang menyediakan fitur manajemen produk, kategori, dan transaksi.
API ini dirancang untuk kebutuhan sistem penjualan, inventori, atau e-commerce.

---

## 🚀 Fitur Utama

### **1. Category API**

* **POST** `/api/category` → Menambahkan kategori baru

### **2. Transaksi API**

* **GET** `/api/transaksi` → Menampilkan daftar transaksi
* **POST** `/api/transaksi` → Menambahkan transaksi baru

### **3. Product API**

* **POST** `/api/product/create-zero-stock` → Membuat produk dengan stok awal 0
* **PATCH** `/api/product/update-stock/{id}` → Update stok produk
* **GET** `/api/product/search` → Pencarian produk
* **GET** `/api/product/delete-zero-stock` → Menghapus produk dengan stok 0

---

## 📁 Instalasi Project

### 1. Clone repository

```
git clone https://github.com/username/product-api.git
cd product-api
```

### 2. Install dependency Laravel

```
composer install
```

### 3. Copy environment

```
cp .env.example .env
```

### 4. Generate key

```
php artisan key:generate
```

### 5. Atur database pada `.env`

```
DB_DATABASE=productdb
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Migrasi database

```
php artisan migrate
```

### 7. Jalankan server

```
php artisan serve
```

---

## 🧪 Dokumentasi API (Postman)

### 📌 **1. Menambahkan Kategori**

**POST**
`/api/category`

**Body (JSON)**

```json
{
  "name": "Peralatan Rumah Tangga"
}
```

---

### 📌 **2. Menampilkan Daftar Transaksi**

**GET**
`/api/transaksi`

---

### 📌 **3. Menambahkan Transaksi**

**POST**
`/api/transaksi`

**Body (JSON)**

```json
{
  "product_id": 1,
  "jumlah": 4,
  "total_harga": 120000
}
```

---

### 📌 **4. Update Stok Produk**

**PATCH**
`/api/product/update-stock/1`

**Body (JSON)**

```json
{
  "stok": 20
}
```

---

### 📌 **5. Hapus Produk Stok 0**

**GET**
`/api/product/delete-zero-stock`

---

### 📌 **6. Search Product**

**GET**
`/api/product/search?keyword=kopi`

---

### 📌 **7. Create Produk dengan Stok 0**

**POST**
`/api/product/create-zero-stock`

**Body (JSON)**

```json
{
  "nama": "Sabun Cuci Tangan",
  "harga": 15000
}
```

✔ Cara install JWT
✔ Step-by-step alur API

Tinggal bilang, nanti saya tambahkan ke README-nya.

