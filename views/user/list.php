<div class="container mt-5 mb-5">
    <div class="row">
        <h2>Users</h2>
        <p><a href="/user/add" class="btn btn-success">Create user</a></p>
<table class="table">
    <tr>
        <th>Id</th>
        <th>username</th>
        <th>password</th>
        <th>email</th>
        <th>phone</th>
        <th>role</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
     <?php foreach($users as $row): ?>
       <tr>
        <td><?= $row->id; ?></td>
        <td><?= $row->username; ?></td>
         <td><?= $row->password; ?></td>
        <td><?= $row->email; ?></td>
        <td><?= $row->phone; ?></td>
           <td></td>
        <td><?= $row->role; ?></td>
        <td>
            <div class="btn-group">
                 <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Action
                 </button>
                     <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/user/view/<?= $row->id; ?>">View</a></li>
                        <li><a class="dropdown-item" href="/user/update/<?= $row->id; ?>">Edit</a></li>
                        <li><a class="dropdown-item" href="/user/delete/<?= $row->id; ?>">Delete</a></li>
                     </ul>
            </div>
        </td>
       </tr> 
     <?php endforeach; ?>     
</table>

    <?php if($pagecount > 0): ?>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <?php for($page = 1; $page <= $pagecount; $page++): ?>
                <li class="page-item"><a class="page-link" href="/user/list?page=<?= $page ?>"><?= $page ?></a></li>
                <?php endfor; ?>
               
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
        <?php endif;  ?>
    </div>
</div>