from OpenGL.GL import *
from OpenGL.GLUT import *
from OpenGL.GLU import *

# Function to draw the house
def draw_house():
    glClear(GL_COLOR_BUFFER_BIT)
    
    # Draw the base of the house (square)
    glBegin(GL_QUADS) 
    glColor3f(0.8, 0.5, 0.2)  # Brown color for the house
    glVertex2f(-0.5, -0.5)
    glVertex2f(0.5, -0.5)
    glVertex2f(0.5, 0.0)
    glVertex2f(-0.5, 0.0)
    glEnd()

    # Draw the roof (triangle)
    glBegin(GL_TRIANGLES)
    glColor3f(0.9, 0.1, 0.1)  # Red color for the roof
    glVertex2f(-0.6, 0.0)
    glVertex2f(0.0, 0.5)
    glVertex2f(0.6, 0.0)
    glEnd()

    glFlush()

# Initialize OpenGL and create window
def init():
    glClearColor(0.7, 0.9, 1.0, 1.0)  # Light blue background (sky)
    glMatrixMode(GL_PROJECTION)
    glLoadIdentity()
    gluOrtho2D(-1.0, 1.0, -1.0, 1.0)

# Main function
def main():
    glutInit()
    glutInitDisplayMode(GLUT_SINGLE | GLUT_RGB)
    glutInitWindowSize(500, 500)
    glutInitWindowPosition(100, 100)
    glutCreateWindow(b"2D House using OpenGL")
    init()
    glutDisplayFunc(draw_house)
    glutMainLoop()

if __name__ == "__main__":
    main()
