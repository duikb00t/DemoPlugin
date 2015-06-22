<form method="POST" id="location" action="">

  <div id="suggestions" class="alert alert-warning" role="alert">
    <h4>Please insert a city...</h4>
  </div>


  <div class="form-group">
    <label for="loc"><?php echo __( 'Location' , 'duikb00t-Demo-Plugin') ?>:</label>
    <input type="text" name="location_name" class="form-control" id="loc" placeholder="Search for a location">
  </div>

  <input type="submit" class="btn btn-info" name="submit" />

</form>
