PFont font;
// The font must be located in the sketch's 
// "data" directory to load successfully

PrintWriter output;


void setup() {
  size(320, 480);
  background(255);

  font = loadFont("DINNextRoundedLTPro-Regular-28.vlw");
  textFont(font);
  textAlign(CENTER);
  // Create a new file in the sketch directory
}

void draw() {
  // Nothing happens in draw() in this example!
}


// Whenever a user presses a key the code written inside keyPressed() is executed.
void keyPressed() {

  if (key == 'w') {
    output = createWriter("curr.txt");
    background(255);
    fill(0);
    text("Haus der Kunst", width/2, height/2);
    output.print(3);
    output.flush(); // Writes the remaining data to the file
    output.close(); // Finishes the file
    println("3  -  Haus Der Kunst");
  }
  else if (key == 's') {
    output = createWriter("curr.txt");
    background(255);
    fill(0);
    text("Naked Sunbathing", width/2, height/2);
    output.print(2);
    output.flush(); // Writes the remaining data to the file
    output.close(); // Finishes the file
    println("2  -  Naked Sunbathing");
  }
  else if (key == 'a') {
    output = createWriter("curr.txt");
    background(255);
    fill(0);
    text("room for imagination", width/2, height/2);
    output.print(1);
    output.flush(); // Writes the remaining data to the file
    output.close(); // Finishes the file
    println("1  -  Room For Imagination");
  }
  else if (key == 'f') {
    output = createWriter("curr.txt");
    background(255);
    fill(0);
    text("Thaaaaaaiiii", width/2, height/2);
    output.print(0);
    output.flush(); // Writes the remaining data to the file
    output.close(); // Finishes the file
    println("0  -  Thai");
  }
  else if (key == 'd') {
    output = createWriter("curr.txt");
    background(255);
    fill(0);
    text("Burger Awesomeness", width/2f, height/2);
    output.print(4);
    output.flush(); // Writes the remaining data to the file
    output.close(); // Finishes the file
    println("4  -  Burger House");
  }
}

