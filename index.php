<?php include('includes/header.php'); ?>

    <section class="page-wrap">
        <?php if (isset($errorMessage) && !empty($errorMessage)) {
            print "<p class='error-message'>$errorMessage <span class='error-message-close'>X</span></p>"; 
        } ?>

        <form class="dvd-submit-form" method="post" action="index.php">
            <fieldset class="fieldset-add-title">
                <div class="field-dvd-title">
                    <label class="label-dvd-title" for="dvd-title">DVD Title</label>
                    <input type="text" name="dvd-title" id="dvd-title" autofocus autocomplete="off">
                </div>
                <div class="field-dvd-year">
                    <label class="label-dvd-year" for="dvd-year">Year of release</label>
                    <select id="dvd-year" name="dvd-year">            
                        <option value="">Please select</option>
                        <?php generateYearOptions(50) ?>

                    </select>
                </div>
                <input type="text" name="dvd-imdbid" id="dvd-imdbid" class="hidden">
                <div class="suggestion">
                </div>
                <button type="submit" name="update" value="add"><i class="fa fa-plus-circle">Add</i></button>
            </fieldset>        
            <ul class="dvd-list">
                <?php
                foreach ($DVDS as $DVD) {
                    $dvdID          = $DVD['id'];
                    $dvdTitle       = $DVD['title'];
                    $dvdYear        = $DVD['year'];
                    $dvdPlot        = $DVD['plot'];
                    $dvdPoster      = $DVD['posterURL'];
                    $dvdDirector    = $DVD['director'];
                    $dvdGenre       = $DVD['genre'];

                    ?>
                        <li id="dvd-<?php print $dvdID; ?>" class="media-item cf">
                            <p class="media-item-title-year">
                                <span class="media-item-title"><?php print $dvdTitle; ?></span> - <span class="media-item-year"><?php print $dvdYear; ?></span>
                            </p> 
                            <div class="media-item-edit">
                                <a href="#" class="media-item-detail-toggle">Details</a>
                                <input type="checkbox" name="delete[<?php print $dvdID; ?>]" class="delete-item" id="delete[<?php print $dvdID; ?>]">
                                <label for="delete[<?php print $dvdID; ?>]"><i class="fa fa-trash-o"></i></label>
                            </div>
                            <div class="media-item-detail">
                                <div class="media-item-detail-poster">
                                    <img src="<?php print $dvdPoster; ?>" class="media-item-poster-img">
                                </div>
                                <div class="media-item-detail-meta">
                                    <div class="media-item-plot">
                                        <p><?php print $dvdPlot; ?></p>
                                    </div>
                                    <p class="media-item-director">
                                        <strong>Directed by:</strong> <span><?php print $dvdDirector; ?></span>
                                    </p>
                                    <p class="media-item-genre">
                                        <strong>Genre:</strong> <span><?php print $dvdGenre; ?></span>
                                    </p>
                                    </div>
                                    <!-- TODO: add more details -->
                                </div>
                            </div>
                        </li>
                <?php } ?>
            </ul>
            <button type="submit" name="update" value="delete" class="submit-delete"><i class="fa fa-trash-o"></i>Delete</button>
            <div class="total-count">
                <p><strong>Total:</strong> <?php print count($DVDS); ?></p>
            </div>
            <div class="check-all">
                <input type="checkbox" id="check-all-delete">
                <label for="check-all-delete" disabled="true">Check all</label>
            </div>
        </form>

<?php include('includes/footer.php'); ?>
