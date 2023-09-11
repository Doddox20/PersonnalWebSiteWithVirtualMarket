<footer class="pieds" >
  
  
  <!-- Copyright -->
  
    <p>© 2022 Copyright: Dorian Contal </p>

    <div class="reseau">
      <i class='bx bxl-linkedin-square bx-sm'></i>
      <i class='bx bxl-discord-alt bx-sm'></i>
      <i class='bx bxl-github bx-sm'></i>
      <i class='bx bxl-twitter bx-sm'></i>
    </div>
     
  <!-- Copyright -->

</footer>
<script>

var boutique = document.querySelectorAll(".main--nav .nav--menu--connexion ul li:last-child")

boutique.forEach(function(boutique) {
    boutique.addEventListener('mouseover', function() {
      this.classList.add('show');
    });
  
    boutique.addEventListener('mouseout', function() {
      this.classList.remove('show');
    });
});

</script>