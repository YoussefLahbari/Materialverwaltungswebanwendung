import tkinter as tk
import webbrowser
import os

def stop_server():
    vbs_script_path = r"C:\xampp\htdocs\tests Prefecture\CrudMatAuth\launch_commands.vbs"
    # Call the VBScript function to stop the server
    os.system('cscript "' + vbs_script_path + '" StopServer')

def open_browser():
    webbrowser.open("http://127.0.0.1:8000/")

def hide_loading():
    label.pack_forget()
    # Button to open the browser
    open_button = tk.Button(loading_window, text="Open Application", command=open_browser)
    open_button.pack(pady=5)        


loading_window = tk.Tk()
loading_window.title("Launching Application")
loading_window.geometry("300x150")

label = tk.Label(loading_window, text="Loading...", font=("Arial", 12))
label.pack(pady=20)

# Schedule the hide_loading function to be called after 10 seconds
loading_window.after(10000, hide_loading)

# Button to stop the server
stop_button = tk.Button(loading_window, text="Arrêter le serveur", command=stop_server)
stop_button.pack(pady=5)

loading_window.mainloop()
