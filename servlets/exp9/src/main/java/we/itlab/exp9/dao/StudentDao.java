package we.itlab.exp9.dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.ArrayList;
import java.util.List;

import we.itlab.exp9.modals.Student;

public class StudentDao {

    private String URL;
    private String USER;
    private String PASSWORD;

    public StudentDao( String URL, String username, String password ) {

        this.URL = URL;
        this.USER = username;
        this.PASSWORD = password;

        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (ClassNotFoundException e) {
            System.out.println("Error Loading Driver");
            System.out.println(e);
        }

    }

    public List<Student> search(String query) {

        List<Student> studs = new ArrayList<>();
        String selectQuery = "SELECT * FROM students WHERE rollno LIKE ? OR name LIKE ? OR dept LIKE ?;";

        try( Connection connection = DriverManager.getConnection(URL, USER, PASSWORD) ) {

            PreparedStatement stmt = connection.prepareStatement(selectQuery);

            stmt.setString(1, "%" + query + "%");
            stmt.setString(2, "%" + query + "%");
            stmt.setString(3, "%" + query + "%");

            try ( ResultSet rs = stmt.executeQuery() ) {
                while( rs.next() ) {
                    studs.add( new Student( 
                        rs.getString("rollno"),
                        rs.getString("name"),
                        rs.getString("dept")
                    ));
                }
            }

        } catch ( SQLException ex ) {
            System.out.println(ex);
        }

        return studs;
    }


    public boolean save(Student stud) {

        String insertQuery = "INSERT INTO students ( rollno, name, dept ) VALUES (?, ?, ?)";

        try( Connection connection = DriverManager.getConnection(URL, USER, PASSWORD) ) {

            PreparedStatement stmt = connection.prepareStatement(insertQuery);

            stmt.setString(1, stud.getRollno());
            stmt.setString(2, stud.getName());
            stmt.setString(3, stud.getDept());

            int count = stmt.executeUpdate();
            
            return count > 0 ;
            
        } catch (SQLException ex) {
            System.out.println(ex);
            return false;
        }
    }
}
