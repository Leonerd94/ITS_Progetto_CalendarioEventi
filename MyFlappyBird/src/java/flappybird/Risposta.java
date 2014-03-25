/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package flappybird;

/**
 *
 * @author Giacomo
 */
public class Risposta {
    
    public static Risposta OK = new Risposta("OK");
    
    public String messaggio;
    
    public Risposta(String m){
        messaggio = m;
    }
}
