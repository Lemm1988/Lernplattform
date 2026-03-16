<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('memory_limit', '512M');
error_reporting(E_ALL);
require_once __DIR__ . '/../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="row">
                <div class="col-md-4 col-lg-3">
                </div>
                <div class="col-md-8 col-lg-9">
                    <h1 class="mb-3"><i class="bi bi-file-code me-2"></i>Java</h1>
                    <nav class="mb-4">
                        <a class="btn btn-outline-primary me-2" href="java2.php">&laquo; Zurück</a>
                    </nav>
                    <h2>Fortgeschrittene Themen</h2>
                    <h3>Dateioperationen</h3>
                    <p>Java bietet Klassen wie <code>File</code>, <code>FileReader</code>, <code>FileWriter</code> und
                        <code>BufferedReader</code> für Dateioperationen.</p>
                    <pre><code>import java.io.*;

public class DateiLesen {
    public static void main(String[] args) throws IOException {
        BufferedReader br = new BufferedReader(new FileReader("test.txt"));
        String zeile;
        while ((zeile = br.readLine()) != null) {
            System.out.println(zeile);
        }
        br.close();
    }
}
</code></pre>
                    <h3>Threads und Nebenläufigkeit</h3>
                    <p>Mit <code>Thread</code> und <code>Runnable</code> können parallele Abläufe realisiert werden.</p>
                    <pre><code>class MeinThread extends Thread {
    public void run() {
        System.out.println("Thread läuft!");
    }
}

MeinThread t = new MeinThread();
t.start();
</code></pre>
                    <h3>Netzwerkprogrammierung</h3>
                    <p>Java unterstützt Netzwerkkommunikation mit <code>Socket</code> und <code>ServerSocket</code>.</p>
                    <pre><code>import java.net.*;

Socket s = new Socket("example.com", 80);
// ...
s.close();
</code></pre>
                    <h2>Praxisbeispiele</h2>
                    <h3>Beispiel: Wortzähler</h3>
                    <pre><code>public class Wortzaehler {
    public static int countWords(String text) {
        String clean = text.trim().replaceAll("\\s+", " ");
        if (clean.isEmpty()) return 0;
        return clean.split(" ").length;
    }

    public static void main(String[] args) {
        String s = "Java ist einfach zu lernen.";
        System.out.println(countWords(s)); // 5
    }
}
</code></pre>
                    <h3>Beispiel: Einfache GUI mit Swing</h3>
                    <pre><code>import javax.swing.*;

public class HalloGUI {
    public static void main(String[] args) {
        JFrame frame = new JFrame("Hallo Welt");
        JLabel label = new JLabel("Willkommen zu Java GUI!");
        frame.add(label);
        frame.setSize(300, 100);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setVisible(true);
    }
}
</code></pre>
                    <h3>Beispiel: Einfache Datenbankabfrage (JDBC)</h3>
                    <pre><code>import java.sql.*;

public class DBBeispiel {
    public static void main(String[] args) throws Exception {
        Connection conn = DriverManager.getConnection("jdbc:mysql://localhost/test", "user", "pass");
        Statement stmt = conn.createStatement();
        ResultSet rs = stmt.executeQuery("SELECT * FROM tabelle");
        while (rs.next()) {
            System.out.println(rs.getString(1));
        }
        rs.close();
        stmt.close();
        conn.close();
    }
}
</code></pre>
                    <h2>Vergleich Java vs. andere Sprachen</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Feature</th>
                                <th>Java</th>
                                <th>C++</th>
                                <th>Python</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Plattformunabhängig</td>
                                <td>Ja</td>
                                <td>Nein</td>
                                <td>Ja</td>
                            </tr>
                            <tr>
                                <td>Garbage Collection</td>
                                <td>Ja</td>
                                <td>Nein</td>
                                <td>Ja</td>
                            </tr>
                            <tr>
                                <td>OOP</td>
                                <td>Ja</td>
                                <td>Ja</td>
                                <td>Ja</td>
                            </tr>
                            <tr>
                                <td>Generics/Templates</td>
                                <td>Ja</td>
                                <td>Ja</td>
                                <td>Nein</td>
                            </tr>
                            <tr>
                                <td>GUI-Framework</td>
                                <td>Swing, JavaFX</td>
                                <td>Qt, wxWidgets</td>
                                <td>Tkinter, PyQt</td>
                            </tr>
                        </tbody>
                    </table>
                    <h2>Häufige Fehlerquellen</h2>
                    <ul>
                        <li>NullPointerException</li>
                        <li>ArrayIndexOutOfBoundsException</li>
                        <li>ClassNotFoundException</li>
                        <li>NumberFormatException</li>
                    </ul>
                    <h2>Ressourcen & Links</h2>
                    <ul>
                        <li><a href="https://docs.oracle.com/javase/tutorial/" target="_blank">Offizielles
                                Java-Tutorial</a></li>
                        <li><a href="https://openjdk.java.net/" target="_blank">OpenJDK</a></li>
                        <li><a href="https://www.learnjavaonline.org/" target="_blank">LearnJavaOnline</a></li>
                    </ul>
                    <nav class="mt-4">
                        <a class="btn btn-outline-primary me-2" href="java2.php">&laquo; Zurück</a>
                    </nav>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>