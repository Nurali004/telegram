<div class="container mt-5">
  <div class="row">
   
    <div class="col-md-6 mb-4">
      <div class="card text-white bg-primary">
        <div class="card-header">Header</div>
        <div class="card-body">
          <h5 class="card-title">Categoriyalar Ro'yxati</h5>
          <a href="/category/add" class="btn btn-info">Qo'shish</a>
          <a href="/category/list" class="btn btn-info">Ro'yxati</a>
        </p>
        </div>
      </div>
    </div>

    <div class="col-md-6 mb-4">
      <div class="card text-white bg-primary">
        <div class="card-header">Header</div>
        <div class="card-body">
          <h5 class="card-title">Postlar Ro'yxati</h5>
          <a href="/post/add" class="btn btn-info">Qo'shish</a>
          <a href="/post/list" class="btn btn-info">Ro'yxati</a>
        </div>
      </div>
    </div> 
    <div class="col-md-6 mb-4">
      <div class="card text-white bg-success">
        <div class="card-header">Header</div>
        <div class="card-body">
          <h5 class="card-title">Userlar Ro'yxati</h5>
         <a href="/user/add" class="btn btn-info">Qo'shish</a>
          <a href="/user/list" class="btn btn-info">Ro'yxati</a>
        </div>
      </div>
    </div>

   
<!--    <div class="col-md-6 mb-4">-->
<!--      <div class="card text-white bg-success">-->
<!--        <div class="card-header">Header</div>-->
<!--        <div class="card-body">-->
<!--          <h5 class="card-title">Commentlar Ro'yxati</h5>-->
<!--          <a href="/comment/add" class="btn btn-info">Qo'shish</a>-->
<!--          <a href="/comment/list" class="btn btn-info">Ro'yxati</a>-->
<!--        </div>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
<!--</div>-->

      <div class="col-md-6 mb-4">
          <div class="card text-white bg-success">
              <div class="card-header">Webhook boshqaruvi</div>
              <div class="card-body">
                  <h5 class="card-title">Telegram Webhook</h5>
                  <a id="toggleBtn" href="#" class="btn btn-info">Yoqish / O‘chirish</a>
                  <div id="result" class="mt-3 bg-light text-dark p-2 rounded"></div>
              </div>
          </div>
      </div>

      <script>
          document.getElementById('toggleBtn').addEventListener('click', function(e) {
              e.preventDefault();

              const btn = this;
              const currentAction = btn.textContent.trim();
              btn.textContent = 'Iltimos, kuting...';
              btn.disabled = true;

              fetch('/shop/toggleWebhook', { method: 'GET' })
                  .then(response => response.json())
                  .then(data => {

                      const status = data.status;


                      document.getElementById('result').textContent = 'Webhook ' + status;

                      if (status === 'enabled') {
                          btn.textContent = 'O‘chirish';
                      } else {
                          btn.textContent = 'Yoqish';
                      }

                      btn.disabled = false;
                  })
                  .catch(() => {
                      document.getElementById('result').textContent = 'Xatolik yuz berdi!';
                      btn.textContent = currentAction;
                      btn.disabled = false;
                  });
          });
      </script>

