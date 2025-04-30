package we.itlab.exp9.modals;

public class Student {
    private String rollno;
    private String name;
    private String dept;

    public Student(String rollno, String name, String dept) {
        this.rollno = rollno;
        this.name = name;
        this.dept = dept;
    }

    public void setRollno(String rollno) {
        this.rollno = rollno;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setDept(String dept) {
        this.dept = dept;
    }

    public String getRollno() {
        return this.rollno;
    }

    public String getName() {
        return this.name;
    }

    public String getDept() {
        return this.dept;
    }
}
