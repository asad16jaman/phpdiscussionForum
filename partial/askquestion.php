<form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="img-thumbnail p-4">
    <div class="form-group">
        <label for="exampleInputEmail1">Problame Title</label>
        <input type="text" name="title" placeholder="Ask question or your problame" class="form-control"
            id="exampleInputTitle" aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Problame Discription</label>
        <textarea name="discription" placeholder="discribe your problame" id="" cols="10" rows="5"
            class="form-control"></textarea>
        <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </div>
</form>