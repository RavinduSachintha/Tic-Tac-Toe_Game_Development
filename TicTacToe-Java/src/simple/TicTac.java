package simple;

import java.util.Scanner;

public class TicTac {
    
    // initializing
    private final int boardArray[];
    private int player;
    private int move;
    private boolean isFinished;
    private final Scanner input;
    
    // constructor
    public TicTac() {
        this.input = new Scanner(System.in);
        this.isFinished = false;
        this.move = -1;
        this.player = 1;
        this.boardArray = new int[4];
        
        for(int i = 0;i < 4;i++) {
            this.boardArray[i] = -1;
        }
        
    }
    
    // play function
    public void playGame() {
        this.startGame();
        while(!this.isFinished) {
            if(this.player == 1) {
                this.player1GetInput(this.input, this.boardArray);
            } else {
                this.player0GetInput(this.boardArray);
            }
            this.moveSelection();
            this.checkWinner();
        }
    }
    
    // start the game
    void startGame() {
        System.out.println("\n ---------------------------------------- ");
        System.out.println("             TIC TAC GAME                   ");
        System.out.println(" ---------------------------------------- ");
        this.displayBoard(this.boardArray);
        System.out.println("...You will be 'X' and machine will be 'O'.....");
    }
    
    // check for the winner
    void checkWinner() {
        int x[] = this.boardArray.clone();
        if((x[0] == 1 && x[3] == 1) || (x[1] == 1 && x[2] == 1)) {
            this.isFinished = true;
            System.out.println("\n\t You won !!!\n");
        } else if ((x[0] == 0 && x[3] == 0) || (x[1] == 0 && x[2] == 0)) {
            this.isFinished = true;
            System.out.println("\n\t You lost !!!\n");
        } else {
            for(int i = 0;i < x.length;i++) {
                if(x[i] == -1) break;
                else if(i == x.length-1) {
                    this.isFinished = true;
                    System.out.println("\n\t Tie Tie !!!\n");
                }
            }
        }
    }
    
    // get input from player 01
    void player1GetInput(Scanner sc,int[] arr) {
        System.out.print("\n Enter the selection : ");
        int t = sc.nextInt();
        if(t >= 0 && t < arr.length && arr[t] == -1) {
            this.move = t;   
        } else {
            System.out.println(" Your selection is not valid. Try again... ");
            this.player1GetInput(sc, arr);
        }
    }
    
    // get input from player 00
    void player0GetInput(int[] arr) {
        this.move = this.nextMove(arr, 0);
    }
    
    // move according to the player selection
    void moveSelection() {
        if(this.player == 0) {
            this.boardArray[this.move] = 0;
            this.player = 1;
            this.displayBoard(this.boardArray);
            System.out.println(" Machine moved to " + this.move);
        } else {
            this.boardArray[this.move] = 1;
            this.player = 0;
            this.displayBoard(this.boardArray);
            System.out.println(" You moved to " + this.move);
        }
    }
    
    // display the board
    void displayBoard(int[] arr) {
        char a[] = {' ',' ',' ',' '};
        for(int i = 0;i < arr.length;i++) {
            if(arr[i] == 1)
                a[i] = 'X';
            else if(arr[i] == 0)
                a[i] = 'O';
            else
                a[i] = ' ';
        }
        System.out.println("\n   Game Board \n ");
        System.out.println("\t|************|");
        System.out.println("\t|** " + a[0] + " ** " + a[1] +" **|");
        System.out.println("\t|************|");
        System.out.println("\t|** " + a[2] + " ** " + a[3] +" **|");
        System.out.println("\t|************|\n");
    }
    
    // find the next move according to the player
    int nextMove(int arr[],int player) {
        int mv = 0, max = 0;
        for(int i = 0;i < arr.length;i++) {
            if(arr[i] == -1) {
                int test[] = arr.clone();
                test[i] = player;
                int k = this.winningChances(test);
                if(k >= max) {
                    max = k; mv = i;
                }
            }
        }
        return mv;
    }
    
    // count the winning chances for an array
    int winningChances(int[] arr) {
        int count = 0;
        int x = this.arraySizeCounter(arr); // number of (-1)s
        int p[] = new int[x];
        for(int i = 0;i < (int)Math.pow(2, x);i++) {
            int mappedArray[] = this.mappingArray(arr.clone(), p);
            if(this.isaWinTime(mappedArray))
                count++;
            p = this.incrementArray(p);
        }
        return count;
    }
    
    // mapping array b into array a
    int[] mappingArray(int[] a,int[] b) {
        for(int i = 0,j = 0;i < a.length;i++) {
            if(a[i] == -1) {
                a[i] = b[j];
                j++;
            }
        }
        return a;
    }
    
    // count (-1)s as the size of new array
    int arraySizeCounter(int[] arr) {
        int count = 0;
        for(int i = 0;i < arr.length;i++) {
            if(arr[i] == -1)
                count++;
        }
        return count;
    }
    
    // increment the array by 1 as a binary number
    int[] incrementArray(int[] arr) {
        int co = 1;
        for(int i = arr.length - 1;i >= 0;i--) {
            if(co == 0)
                break;
            int tmp = arr[i];
            arr[i] = (arr[i] + co) % 2;
            co = (tmp + co) / 2;
        }
        return arr;
    }
    
    // check for a win time which is fully filled
    boolean isaWinTime(int[] arr) {
        int a[] = {1, 0, 0, 1};
        int b[] = {0, 1, 1, 0};
        return this.isEqual(arr, a) || this.isEqual(arr, b);
    }
    
    // compare 2 arrays
    boolean isEqual(int[] a,int[] b) {
        int k = 1;
        if(a.length == b.length) {
            for(int i = 0;i < a.length;i++){
                if(a[i] != b[i]) {
                    k = 0; break;
                }
            }
        } else {
            k = 0;
        }
        return k==1;
    }
}