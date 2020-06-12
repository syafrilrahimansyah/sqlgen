<main>
    <div class="container-fluid">
        <h1 class="mt-4">Config</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item">Config</li>
            <li class="breadcrumb-item">Template</li>
        </ol>
        <div class="container my-5">
        
            <div style="margin-bottom:10px">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-table mr-1"></i>Templates</div>
                    <div class="card-body">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add">Add Template</button>
                        <div class="float-right" style="margin-bottom:10px">
                            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="<?php echo base_url('Config/template')?>" method="GET">
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" name="search" value="<?php echo (isset($search))?$search:''?>"  />
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Template Name</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Last Updated</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($data as $template){?>
                                    <tr data-toggle="modal" data-target="#update<?php echo $template['id']?>">
                                        <td><?php echo $template['id']?></td>
                                        <td><?php echo $template['name']?></td>
                                        <td><?php echo $template['created']?></td>
                                        <td><?php echo $template['last_updated']?></td>
                                    </tr>
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                Total row - <?php echo $total_row?> 
                            </div>
                            <div class="col-md-6">
                                <div class="float-right">
                                    <nav aria-label="Page navigation example ">
                                      <?php echo $pagination?>
                                    </nav>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('Config/add_template')?>" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">Template Name</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Upload Template</label>
                <input type="file" name="userfile" class="form-control">
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php foreach($data as $template){?>
<div class="modal fade" id="update<?php echo $template['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('Config/updt_template')?>" method="POST" enctype="multipart/form-data">
        <input type="text" class="form-control" name="id" value="<?php echo $template['id']?>" hidden>
            <div class="form-group">
                <label for="exampleFormControlInput1">Template Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo $template['name']?>">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Upload Template</label>
                <input type="file" name="userfile" class="form-control">
            </div>
            <div class="form-group">
              <a href="<?php echo base_url('Config/download/'.$template['name'])?>"><button type="button" class="btn btn-primary">Download Template</button></a>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#delete<?php echo $template['id']?>">Delete</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="delete<?php echo $template['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Template</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Delete Template : <?php echo $template['name']?>
      </div>
      <div class="modal-footer">
      <form action="<?php echo base_url('Config/del_template')?>" method="POST">
        <input type="text" class="form-control" name="id" value="<?php echo $template['id']?>" hidden>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Confirm</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php }?>