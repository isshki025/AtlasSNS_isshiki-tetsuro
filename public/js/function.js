// Toggle Menu
const btn = document.querySelector('#toggleBtn');
const navBox = document.querySelector('.nav-box');

btn.addEventListener('click', (event) => {
  btn.classList.toggle('active');
  navBox.classList.toggle('active');
  event.stopPropagation();
});

navBox.addEventListener('click', (event) => {
  event.stopPropagation();
});

document.addEventListener('click', () => {
  if (btn.classList.contains('active')) {
    btn.classList.remove('active');
    navBox.classList.remove('active');
  }
});


// modal window
document.addEventListener('DOMContentLoaded', function () {
  const editBtns = document.querySelectorAll('.js-modalOpen');
  const modal = document.getElementById('modal');
  const closeBtn = document.querySelector('.js-modalClose');
  const modalBg = document.querySelector('.modal_bg');

  editBtns.forEach((btn) => {
    btn.addEventListener('click', (event) => {
      event.preventDefault();
      const postId = event.target.dataset.postId;
      const postContent = event.target.dataset.postContent;
      const actionUrl = `/posts/${postId}`;

      document.getElementById('editForm').action = actionUrl;
      document.getElementById('editPost').value = postContent;
      modal.style.display = 'block';
    });
  });

  closeBtn.addEventListener('click', () => {
    modal.style.display = 'none';
  });
  modalBg.addEventListener('click', () => {
    modal.style.display = 'none';
  });

  window.addEventListener('click', (event) => {
    if (event.target == modal) {
      modal.style.display = 'none';
    }
  });
});


// delete alert
const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach((form) => {
  form.addEventListener('submit', (event) => {
    if (!confirm('この投稿を削除します。よろしいでしょうか？')) {
      event.preventDefault();
    }
  });
});


// image preview
document.querySelector("#icon-upload").addEventListener("change", function () {
  const file = this.files[0];
  const reader = new FileReader();
  reader.readAsDataURL(file);
  reader.onload = function (e) {
    document.querySelector("#icon-preview").src = e.target.result;
  };
});
