<x-admin.user.index>
  <form class="my-3" method="post">
    <div class="row">
      <div class="col-6">
        <div class="mb-3">
          <label for="name" class="form-label">Tên người dùng</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="form-control" id="email" name="email">
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="image" class="form-label">Ảnh</label>
          <input class="form-control" type="file" id="image" name="image">
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="date_of_birth" class="form-label">Ngày sinh</label>
          <input class="form-control" type="date" id="date_of_birth" name="date_of_birth">
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="role" class="form-label">Vai trò</label>
          <select class="form-select" id="role" name="role">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </div>
      <div class="col-6">
        <div class="mb-3">
          <label for="status" class="form-label"></label>
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault" name="status">
            <label class="form-check-label" for="flexSwitchCheckDefault">Trạng thái hoạt động</label>
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Xác nhận</button>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
  </form>
</x-admin.user.index>