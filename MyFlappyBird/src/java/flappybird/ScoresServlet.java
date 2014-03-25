/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package flappybird;

import com.google.gson.Gson;
import com.google.gson.stream.JsonWriter;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.PrintWriter;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

/**
 *
 * @author Giacomo
 */
@WebServlet(name = "ScoresServlet", urlPatterns = {"/ScoresServlet"})
public class ScoresServlet extends HttpServlet {

    /**
     * Processes requests for both HTTP <code>GET</code> and <code>POST</code>
     * methods.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    protected void processRequest(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        response.setContentType("text/html;charset=UTF-8");
        PrintWriter out = response.getWriter();
        try {
            /* TODO output your page here. You may use following sample code. */
            out.println("<!DOCTYPE html>");
            out.println("<html>");
            out.println("<head>");
            out.println("<title>Servlet ScoresServlet</title>");            
            out.println("</head>");
            out.println("<body>");
            out.println("<h1>Servlet ScoresServlet at " + request.getContextPath() + "</h1>");
            out.println("</body>");
            out.println("</html>");
        } finally {
            out.close();
        }
    }

    // <editor-fold defaultstate="collapsed" desc="HttpServlet methods. Click on the + sign on the left to edit the code.">
    /**
     * Handles the HTTP <code>GET</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        try {        
            PrintWriter writer = response.getWriter();
            
            writer.print("[");
            
            Connection con = getConnection();
         
            
            Statement stmt = con.createStatement();
            //query apperta...si legge direttamente dal db
          
            ResultSet rs = stmt.executeQuery("SELECT Username, Score, Timestamp FROM dbo.Top5Scores");

            boolean first = true;
            while (rs.next()) {
                Score punt = new Score();
                punt.giocatore = rs.getString(1);
                punt.punteggio = rs.getString(2);
                punt.tempo = rs.getString(3);

                if (first) {
                    first = false;
                }
                else {
                    writer.println(",");
                }

                writer.print("{");
                writer.printf("\"giocatore\": \"%s\"", punt.giocatore);
                writer.printf(", \"punteggio\": \"%s\"",  punt.punteggio);
                writer.printf(", \"tempo\": \"%s\"",  punt.tempo);
                writer.print(" }");

            }
            writer.print("]");
            con.close();
        } catch (SQLException ex) {
            Logger.getLogger(ScoresServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (InstantiationException ex) {
            Logger.getLogger(ScoresServlet.class.getName()).log(Level.SEVERE, null, ex);
        }
        
    }

    /**
     * Handles the HTTP <code>POST</code> method.
     *
     * @param request servlet request
     * @param response servlet response
     * @throws ServletException if a servlet-specific error occurs
     * @throws IOException if an I/O error occurs
     */
    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {
        try {
            BufferedReader reader = request.getReader();
            
            Gson gson = new Gson();
            Score punt = gson.fromJson(reader, Score.class);
            
            Connection con = getConnection();
            
            
            Statement stmt = con.createStatement();
            
            
            String sql = "INSERT INTO dbo.Scores "
                    + "(Username, Score) VALUES ("
                    + "'"+punt.giocatore+"'"
                    + ", "+punt.punteggio + ")";
                    
            
            stmt.execute(sql);
            
            JsonWriter writer = new JsonWriter(response.getWriter());
            gson.toJson(
                    Risposta.OK,
                    Risposta.class,
                    writer
            );
            
            con.close();
            
        } catch (InstantiationException ex) {
            Logger.getLogger(ScoresServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(ScoresServlet.class.getName()).log(Level.SEVERE, null, ex);
        }
        
        
    }

    /**
     * Returns a short description of the servlet.
     *
     * @return a String containing servlet description
     */
    @Override
    public String getServletInfo() {
        return "Short description";
    }// </editor-fold>

    
     private Connection getConnection() throws InstantiationException{
        Connection con = null;
        try {
            Class .forName("com.microsoft.sqlserver.jdbc.SQLServerDriver")
                    .newInstance();
            
             con = DriverManager.getConnection(
                    "jdbc:"
                            + "sqlserver:"
                            + "//6-PC;"
                            + "instanceName=LEO_SQL;"
                            + "databaseName=FlappyBird;"
                            + "user=flappybird;"
                            + "password=flappybird;");
             
        } catch (ClassNotFoundException ex) {
            Logger.getLogger(ScoresServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (IllegalAccessException ex) {
            Logger.getLogger(ScoresServlet.class.getName()).log(Level.SEVERE, null, ex);
        } catch (SQLException ex) {
            Logger.getLogger(ScoresServlet.class.getName()).log(Level.SEVERE, null, ex);
        } 
        return con;
    }
    
    
}

