<SCRIPT LANGUAGE="javascript">
var getin = prompt("Inserire la password:","")
if (getin=="12344")
{
alert('Password corretta. Benvenuto!')
location.href='userPageSystem.php'
}
else
{
alert('Password errata. Sarai reinidirizzato alla pagina precedente!')
location.href='userPage.php'
}
</SCRIPT>