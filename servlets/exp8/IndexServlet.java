import jakarta.servlet.*;
import jakarta.servlet.http.*;

import java.io.*;

public class IndexServlet extends HttpServlet {

    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws IOException, ServletException{

        resp.setContentType("text/html");
        PrintWriter out = resp.getWriter();

        out.println("<h1>Hello World</h1>");
    }
}