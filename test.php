<html>
    <ol id="lista" style="position:relative; left: 200px"></ol>
<script>
function addToList(list, ctr, yr, wp) {
      var li = document.createElement("li");
      var a1 = document.createElement("a");
      a1.className = "country";
      li.appendChild(a1);
      a1.text = ctr;
      var a2 = document.createElement("a");
      a2.className = "year";
      li.appendChild(a2);
      a2.text = yr;
      var a3 = document.createElement("a");
      a3.className = "country";
      li.appendChild(a3);
      a3.text = wp;
      document.getElementById(list).appendChild(li);
    }</script>
    <?php
    include 'DBAcess.php';
      $rez=DBAcess::getInstance()::selectAll();
      while($atacuri=$rez->fetch_assoc()){
        $country=$atacuri["country_txt"];
        $year=$atacuri["iyear"];
        $weapon=$atacuri["weaptype1_txt"];
        echo "<script type='text/javascript'>addToList(\"lista\",\"$country\",$year,\"$weapon\")</script>";
      }
      ?>
      </html>