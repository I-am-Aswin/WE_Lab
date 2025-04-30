package we.itlab.simpleapp;

import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;

import java.io.PrintWriter;
import java.io.IOException;

public class IndexServlet extends HttpServlet {

    @Override
    protected void doGet( HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {

        // PrintWriter out = resp.getWriter();
        // resp.setContentType("text/html");
        // out.println("<style>body{ width:100vw; height:100vh; }\n body,div{ display:flex; justify-content:center; align-items:center; flex-direction: column; gap: 2rem }\ndiv{ padding: 5rem; border: 1px solid grey; }</style>");
        // out.println("<div>");
        // out.println("<h2>Counter </h1>");
        // out.println("<h3 id=\"counter\">0</h3>");
        // out.println("<button onclick=\"document.getElementById('counter').innerHTML=Number(document.getElementById('counter').innerHTML) + 1\">Increment</button>");
        // out.println("</div>");

        resp.getRequestDispatcher("/pages/counter.jsp").forward(req, resp);
    }

}
