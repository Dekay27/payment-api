# **Bank API - Fountainhead Christian School**

## **Table of Contents**
1. [Introduction](#introduction)
2. [Authentication](#authentication)
3. [Endpoints](#endpoints)
   - [Verify Student Details](#verify-student-details)
   - [Post a Transaction](#post-a-transaction)
   - [Retrieve a Single Payment](#retrieve-a-single-payment)
4. [Error Handling](#error-handling)
5. [Additional Notes](#additional-notes)
6. [Contact Information](#contact-information)

---

## **Introduction**
The Bank API allows seamless integration with Fountainhead Christian School's system to:
- Verify student details.
- Post payment transactions.
- Retrieve payment information.

**Base URL**:  
`https://pay.hightelbank.com`

---

## **Authentication**

### **1. Create an Account**
**Endpoint**:  
`POST /verify`

**Description**:  
To authenticate with the API, create an account by sending user details in the body of the request.

**Sample Request**:
\`\`\`json
POST /verify
{
  "username": "example_user",
  "password": "securepassword123"
}
\`\`\`

---

### **2. Log In and Retrieve a Web Token**
**Endpoint**:  
`POST /login`

**Description**:  
Log in to retrieve the JWT (JSON Web Token). Use this token in all subsequent API calls as an authorization header.

**Sample Request**:
\`\`\`json
POST /login
{
  "username": "example_user",
  "password": "securepassword123"
}
\`\`\`

**Response**:
\`\`\`json
{
  "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
}
\`\`\`

**Usage**:  
Include the token as a Bearer Token in the `Authorization` header:
\`\`\`
Authorization: Bearer {token}
\`\`\`

---

## **Endpoints**

### **1. Verify Student Details**
**Method**: `GET`  
**URL**: `https://api.hightelconsult.com/student`

**Description**:  
Verifies student details using their `index_no`.

| Parameter   | Type   | Required | Description                   |
|-------------|--------|----------|-------------------------------|
| `index_no`  | String | Yes      | Index number of the student.  |

**Sample Request**:
\`\`\`http
GET /student?index_no=12345
\`\`\`

**Sample Response**:
\`\`\`json
{
  "index_no": "12345",
  "full_name": "John Doe",
  "status": "verified"
}
\`\`\`

---

### **2. Post a Transaction**
**Method**: `POST`  
**URL**: `https://api.hightelconsult.com/pay`

**Description**:  
Posts a payment transaction to the system.

| Parameter       | Type   | Required | Description                                 |
|------------------|--------|----------|---------------------------------------------|
| `index_no`       | String | Yes      | Index number of the student.               |
| `full_name`      | String | Yes      | Full name of the student.                  |
| `payment_date`   | Date   | Yes      | Date of payment in `YYYY-MM-DD` format.    |
| `fee_type_code`  | String | Yes      | Type of payment (TUITION, FEEDING, TRANSPORT). |
| `amount_paid`    | Number | Yes      | Amount paid (numbers only).                |
| `trans_ref`      | String | Yes      | Unique bank transaction ID.                |
| `bank`           | String | Yes      | Name of the bank.                          |

**Sample Request**:
\`\`\`json
POST /pay
{
  "index_no": "12345",
  "full_name": "John Doe",
  "payment_date": "2024-12-01",
  "fee_type_code": "TUITION",
  "amount_paid": 5000.00,
  "trans_ref": "BANK123",
  "bank": "Global Bank"
}
\`\`\`

**Sample Response**:
\`\`\`json
{
  "status": "success",
  "message": "Payment recorded successfully"
}
\`\`\`

---

### **3. Retrieve a Single Payment**
**Method**: `GET`  
**URL**: `https://api.hightelconsult.com/verify`

**Description**:  
Retrieves details of a specific payment using `index_no` and `trans_ref`.

| Parameter   | Type   | Required | Description                           |
|-------------|--------|----------|---------------------------------------|
| `index_no`  | String | Yes      | Index number of the student.          |
| `trans_ref` | String | Yes      | Unique bank transaction ID.           |

**Sample Request**:
\`\`\`http
GET /verify?index_no=12345&trans_ref=BANK123
\`\`\`

**Sample Response**:
\`\`\`json
{
  "index_no": "12345",
  "trans_ref": "BANK123",
  "payment_date": "2024-12-01",
  "amount_paid": 5000.00,
  "fee_type_code": "TUITION"
}
\`\`\`

---

## **Error Handling**
| HTTP Status Code | Message              | Description                            |
|-------------------|----------------------|----------------------------------------|
| 200               | Success             | Request was successful.                |
| 400               | Bad Request         | Missing or invalid parameters.         |
| 401               | Unauthorized        | Invalid or missing authentication token. |
| 404               | Not Found           | Resource not found.                    |
| 500               | Internal Server Error | An error occurred on the server.      |

---

## **Additional Notes**
1. **Missing Parameters**: Only `index_no` may be absent, in which case the phone number can be used instead.
2. **Payment Date Format**: Must be `YYYY-MM-DD`.
3. **Amount Format**: Numbers only (e.g., `4350.00`). Avoid commas.
4. **Fee Types**:  
   - **TUITION**: Tuition fees.  
   - **FEEDING**: Feeding fees.  
   - **TRANSPORT**: Transport fees.

---

## **Contact Information**
For questions or support:
- **Email**: dannykumah27@gmail.com
- **Phone**: +233 (0)26 997 7536
- **Website**: [https://www.hightelconsult.com](https://www.hightelconsult.com)
"""

