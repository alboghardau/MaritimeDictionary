                <table id="menu"><tr>
                        <td>
                            <?php
                            if($_SESSION['page']==2)
                            {
                                echo '<img src="img/addwp.png" alt="addw">';
                            }else{
                                echo '<a href="addw.php" class="addw" ></a> ';
                            }                            
                            ?>                        
                        </td>
                        <td class="space"></td>                                                   
                            <td >
                            <?php
                            if($_SESSION['page']==5)
                            {
                                echo '<img src="../img/allwordsp.png" alt="allw"/>';
                            }else{
                                echo '<a href="allwords.php?action=1&id=0" class="allw" ></a> ';
                            }                            
                            ?>
                        </td>
                         <td class="space"></td>
                        <td >
                            <?php
                            if($_SESSION['page']==3)
                            {
                                echo '<img src="img/editwp.png" alt="editw">';
                            }else{
                                echo '<a href="editw.php?action=1&id=0" class="editw" ></a> ';
                            }                            
                            ?>                            
                        </td>
                        <td class="space"></td>
                        <td >
                            <?php
                            if($_SESSION['page']==4)
                            {
                                echo '<img src="img/catp.png" alt="cat">';
                            }else{
                                echo '<a href="categories.php?action=1&id=0" class="cat" ></a> ';
                            }                            
                            ?>
                        </td>

                            <td class="space"></td>
                        <td >
                            <?php
                            if($_SESSION['page']==1)
                            {
                                echo '<img src="img/infop.png" alt="cat">';
                            }else{
                                echo '<a href="index.php" class="info" ></a> ';
                            }                            
                            ?>
                        </td>
                    </tr></table>