package we.itlab.exp9.routes;

import java.io.IOException;
import java.io.PrintWriter;
import java.util.List;

import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import we.itlab.exp9.dao.StudentDao;
import we.itlab.exp9.modals.Student;

public class StudentRoute extends HttpServlet {

    private final StudentDao dao;

    public StudentRoute() {
        this.dao = new StudentDao("localhost:3306/we_lab", "root", "");
    }

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) {
        
        try {

            List<Student> studs = dao.search("I");

            resp.setContentType("text/html");
            
            PrintWriter out = resp.getWriter();
            
            out.println("<h2>Students: </h2>");
            for( Student stud : studs ) {
                out.println("<h5>" + stud.getRollno() + "\t" + stud.getName() + "\t" + stud.getDept() + "<h5>");
            }

        } catch ( IOException ex ) {
            System.out.println(ex);
        }
    }

}
