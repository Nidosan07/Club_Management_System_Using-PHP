<!-- Edit -->

<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Event</h4></center>
            </div>
            <div class="modal-body">
			<div class="container-fluid">
			<form method="POST" action="edit.php">
				<input type="hidden" class="form-control" name="id" value="<?php echo $row['id']; ?>">
				<div class="row form-group">
				<div class="form-group">
                        <label for="name">Name <span class="text-primary">*</span></label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
				</div>
				<div class="row form-group">
				<div class="form-group">
                        <label for="email">Event Description <span class="text-primary">*</span></label>
                        <textarea row="7" type="text" id="email" name="email" class="form-control" required></textarea>
                    </div>

				</div>

                
				<div class="row form-group">
				<div class="form-group">
                        <label for="club_id">Select Club <span class="text-primary">*</span></label>
                        <select name="club_id" id="club_id" class="form-select rounded-0" required>
                            
                        <?php include_once('fetch.php'); ?>
                            <?php 
                            
                            foreach ($clubs as $club): ?>
                                <option value="<?= $club['id'] ?>"><?= $club['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
					</div>

				<div class="row form-group">
				<div class="form-group">
                        <label for="phone">Venue <span class="text-primary">*</span></label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>

				</div>

				<div class="row form-group">
				<div class="form-group">
                        <label for="attendees">Number of Attendees <span class="text-primary">*</span></label>
                        <input type="number" id="attendees" name="attendees" class="form-control" required>
                    </div>

				</div>

				<div class="row form-group">
				<div class="form-group">
                        <label for="event_date">Event Date <span class="text-primary">*</span></label>
                        <input type="date" id="event_date" name="event_date" class="form-control" required>
                    </div>

				</div>

			


				<div class="row form-group">
				<div class="form-group">
                        <label for="image">Upload Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>
				</div>
				
				
            </div> 
			</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</a>
			</form>
            </div>

        </div>
    </div>
</div>

<!-- Delete -->


<?php include_once('delete1.php'); ?>