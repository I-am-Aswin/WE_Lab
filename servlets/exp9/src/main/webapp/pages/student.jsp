<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" isELIgnored="false" %>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/exp9/assets/style.css">
    <title>Student Page</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 2rem;
        }
        div {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 75%;
        }
        form {
            display: flex;
            flex-direction: row;
            gap: 1rem;
        }
        input[type="text"] {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 0.5rem 1rem;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            text-align: center;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 0.5rem;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

    <div>
        <h3>Students : </h3>

        <form action="/exp9/" method="GET">
            <input type="text" name="query" id="query" placeholder="Search by Roll No, Name, or Department">
            <input type="submit" value="Search">
        </form>

        <table>
            <thead>
                <tr>
                    <th>Register Number</th>
                    <th>Name</th>
                    <th>Department</th>
                </tr>
            </thead>
            <tbody>
                <c:forEach var="student" items="${students}">
                    <tr>
                        <td><c:out value="${student.rollno}" /></td>
                        <td><c:out value="${student.name}" /></td>
                        <td><c:out value="${student.dept}" /></td>
                    </tr>
                </c:forEach>
            </tbody>
        </table>
    </div>

    <div>

        <h3>Add New Student : </h3>

        <form action="/exp9/" method="POST">
            <input type="text" name="rollno" id="rollno" placeholder="Register Number" required>
            <input type="text" name="name" id="name" placeholder="Student Name" required>
            <input type="text" name="dept" id="dept" placeholder="Department" required>
            <input type="submit" value="Add Student">
        </form>


    </div>

    
</body>
</html>