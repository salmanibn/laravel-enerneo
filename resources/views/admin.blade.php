
<style>
.admin-panel-container {
    max-width: 900px;
    margin: 100px auto 40px auto;
    background: rgba(255,255,255,0.04);
    border-radius: 16px;
    box-shadow: 0 4px 24px rgba(0,0,0,0.08);
    padding: 40px 30px 30px 30px;
}
.admin-panel-title {
    color: #4CC9FF;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 30px;
    text-align: center;
}
.user-table th, .user-table td {
    vertical-align: middle;
}
.user-table th {
    color: #4CC9FF;
}
.user-table td {
    color: #fff;
}
.btn-admin {
    background: #4CC9FF;
    color: #181818;
    border: none;
    border-radius: 8px;
    padding: 6px 18px;
    font-weight: 600;
    margin-right: 8px;
    transition: background 0.2s;
}
.btn-admin:hover {
    background: #38bdf8;
    color: #fff;
}
</style>

<div class="admin-panel-container">
    <div class="admin-panel-title">User Management</div>
    <div class="mb-4 text-end">
        <button class="btn-admin" data-bs-toggle="modal" data-bs-target="#addUserModal">+ Add User</button>
    </div>
    <table class="table table-dark table-hover user-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example static data, replace with @foreach($users as $user) in real app -->
            <tr>
                <td>1</td>
                <td>Admin User</td>
                <td>admin@enerneo.com</td>
                <td>Admin</td>
                <td>
                    <button class="btn-admin" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Operator</td>
                <td>operator@enerneo.com</td>
                <td>User</td>
                <td>
                    <button class="btn-admin" data-bs-toggle="modal" data-bs-target="#editUserModal">Edit</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="addName" class="form-label">Name</label>
            <input type="text" class="form-control" id="addName" required>
          </div>
          <div class="mb-3">
            <label for="addEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="addEmail" required>
          </div>
          <div class="mb-3">
            <label for="addRole" class="form-label">Role</label>
            <select class="form-select" id="addRole">
              <option value="Admin">Admin</option>
              <option value="User">User</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="addPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="addPassword" required>
          </div>
          <button type="submit" class="btn-admin">Add User</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit User Modal (static example, should be dynamic in real app) -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content bg-dark text-light">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="editName" class="form-label">Name</label>
            <input type="text" class="form-control" id="editName" value="Admin User" required>
          </div>
          <div class="mb-3">
            <label for="editEmail" class="form-label">Email</label>
            <input type="email" class="form-control" id="editEmail" value="admin@enerneo.com" required>
          </div>
          <div class="mb-3">
            <label for="editRole" class="form-label">Role</label>
            <select class="form-select" id="editRole">
              <option value="Admin" selected>Admin</option>
              <option value="User">User</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="editPassword" class="form-label">Password</label>
            <input type="password" class="form-control" id="editPassword" placeholder="Leave blank to keep current password">
          </div>
          <button type="submit" class="btn-admin">Save Changes</button>
        </form>
      </div>
    </div>
  </div>
</div>



