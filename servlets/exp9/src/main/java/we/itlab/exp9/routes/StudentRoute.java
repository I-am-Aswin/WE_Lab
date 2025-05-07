package we.itlab.exp9.routes;

import java.io.IOException;
import java.util.List;

import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import we.itlab.exp9.dao.StudentDao;
import we.itlab.exp9.modals.Student;

public class StudentRoute extends HttpServlet {

    private final StudentDao dao;

    public StudentRoute() {
        this.dao = new StudentDao("jdbc:mysql://localhost:3306/we_lab", "root", "");
    }

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) {
        
        try {            
            String query = req.getParameter("query");
            query = ( query != null ) ? query : "";
            
            List<Student> studs = dao.search(query);
            
            req.setAttribute("students", studs);
            
            req.getRequestDispatcher("/pages/student.jsp").forward(req, resp);

        } catch ( ServletException | IOException ex ) {
            System.out.println(ex);
        }
    }


    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp ) {
        
        try {

            String rollno = req.getParameter("rollno");
            String name = req.getParameter("name");
            String dept = req.getParameter("dept");

            Student stud = new Student(rollno, name, dept);

            dao.save(stud);

            resp.sendRedirect(req.getContextPath() + "/");

        } catch (IOException e) {
            System.out.println(e);
        }
    }

}
