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
                  <a id="toggleBtn" href="#" class="btn btn-info">Yuklanmoqda</a>
                  <div id="result" class="mt-3 bg-light text-dark p-2 rounded"></div>
              </div>
          </div>
      </div>

      <script>
          const btn = document.getElementById('toggleBtn');
          const resultDiv = document.getElementById('result');


          fetch('/shop/toggleWebhook?check=true')
              .then(res => res.json())
              .then(data => {
                  const status = data.status;
                  if (status.includes('yoqilgan')) {
                      btn.textContent = 'O‘chirish';
                  } else {
                      btn.textContent = 'Yoqish';
                  }
                  resultDiv.textContent = 'Webhook  ' + status;
              })
              .catch(() => {
                  resultDiv.textContent = 'Holatni aniqlashda xatolik!';
                  btn.textContent = 'Yoqish / O‘chirish';
              });

          btn.addEventListener('click', function (e) {
              e.preventDefault();
              btn.disabled = true;
              btn.textContent = 'Iltimos, kuting.';

              fetch('/shop/toggleWebhook')
                  .then(res => res.json())
                  .then(data => {
                      const status = data.status;
                      if (status.includes('yoqilgan')) {
                          btn.textContent = 'O‘chirish';
                      } else {
                          btn.textContent = 'Yoqish';
                      }
                      resultDiv.textContent = 'Webhook ' + status;
                      btn.disabled = false;
                  })
                  .catch(() => {
                      resultDiv.textContent = 'Xatolik yuz berdi!';
                      btn.textContent = 'Yoqish / O‘chirish';
                      btn.disabled = false;
                  });
          });
      </script>

