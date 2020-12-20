<SCRIPT LANGUAGE="javascript">
var getin = prompt("Inserire la password:","")
if (getin=="12346")
{
alert('Password corretta. Benvenuto!')
location.href='userPageRepository.php'
}
else
{
alert('Password errata. Sarai reinidirizzato alla pagina precedente!')
location.href='userPage.php'
}
</SCRIPT>