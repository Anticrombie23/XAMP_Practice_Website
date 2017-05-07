		<!-- Script 8.3 - footer.html -->
  <!-- END CHANGEABLE CONTENT. -->
  </main>

  <footer container class="siteFooter">
      <?php
      $date = date('h:i a m/d/Y', time());
      echo $date;
      echo '<br>'. 'Josh Harm (JHARM3) March/April 2017';
      
      if (isset($_SESSION['userName'])){
          $userName = $_SESSION['userName'];
          echo '<br><p style = "color: green"> Hello, ' . $userName .'!</p>';
      }
          
      
    ?>
    
  </footer>
    
</body>
</html>