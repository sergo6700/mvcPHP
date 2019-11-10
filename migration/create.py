import subprocess

function= raw_input("Enter dir name:")
if function is None:
    print('Please enter function name...')
    function
else:
    tableName = raw_input("Enter table name: ")
    if tableName is None:
        print('Please enter tableName...')
        tableName

command = "php console.php " + function + ' '  + tableName
print command

proc = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE)
script_response = proc.stdout.read()











