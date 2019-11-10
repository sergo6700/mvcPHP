import subprocess

direction = raw_input("Enter directory name: ")
if direction is None:
    print('Please enter directory name...')
else:
    tableName = raw_input("Enter table name: ")
    if tableName is None:
        print('Please enter table name')
command = "php run.php "+ direction + " " + tableName
# if you want output
proc = subprocess.Popen(command, shell=True, stdout=subprocess.PIPE)
script_response = proc.stdout.read()