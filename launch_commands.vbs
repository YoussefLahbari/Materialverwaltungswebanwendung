Set objShell = WScript.CreateObject("WScript.Shell")

' Function to execute commands and retrieve their process IDs
Function ExecuteCommandsAndGetPIDs()
    ' Execute the first command
    Dim devCmd
    Set devCmd = objShell.Exec("cmd /c cd /d ""C:\xampp\htdocs\tests Prefecture\CrudMatAuth"" && npm run dev")

    ' Get the process ID of the first command
    Dim devPID
    devPID = devCmd.ProcessID

    ' Execute the second command
    Dim serveCmd
    Set serveCmd = objShell.Exec("cmd /c cd /d ""C:\xampp\htdocs\tests Prefecture\CrudMatAuth"" && php artisan serve")

    ' Get the process ID of the second command
    Dim servePID
    servePID = serveCmd.ProcessID

    ' Return the process IDs as a string
    ExecuteCommandsAndGetPIDs = devPID & " " & servePID
End Function

' Start loading window
objShell.Run "pythonw.exe ""C:\xampp\htdocs\tests Prefecture\CrudMatAuth\loading_window.py""", 0, False

' Execute commands and retrieve their process IDs
commandPIDs = ExecuteCommandsAndGetPIDs()

' Function to stop the server
Function StopServer()
    ' Split the process IDs string into an array
    commandIDs = Split(commandPIDs, " ")

    ' Kill the processes using their PIDs
    For Each id In commandIDs
        objShell.Run "taskkill /f /pid " & id, 1, False
    Next
End Function


