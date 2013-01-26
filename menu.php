                <table id="menu"><tr>
                        <td>
                            <?php
                            if($_SESSION['page']==2)
                            {
                                echo '<img src="img/engp.png" alt="eng">';
                            }else{
                                echo '<a href="eng.php?action=0" class="eng" ></a> ';
                            }                            
                            ?>                        
                        </td>
                        <td class="space"></td>
                        <td >
                            <?php
                            if($_SESSION['page']==3)
                            {
                                echo '<img src="img/rop.png" alt="ro">';
                            }else{
                                echo '<a href="ro.php?action=0" class="ro" ></a></a> ';
                            }                            
                            ?>                            
                        </td>
                        <td class="space"></td>
                        <td >
                            <?php
                            if($_SESSION['page']==1)
                            {
                                echo '<img src="img/infop.png" alt="info">';
                            }else{
                                echo '<a href="index.php" class="info" ></a></a> ';
                            }                            
                            ?>
                        </td>
                    </tr></table>