function start() {
  handleFocusInput();
  handleClickIcondowloadImage();
}
start();

function handleFocusInput() {
  const searchInput = document.querySelector("#search_img"); // Lấy thẻ input tìm kiếm từ DOM
  const btnFind = document.querySelector("#find");
  let timeoutId; // Biến để lưu trữ ID của timeout

  searchInput.addEventListener("keyup", handleKeyUp); // Gắn sự kiện keyup cho input tìm kiếm
  btnFind.addEventListener("click", searchPhotos); // gắn sự kiện search cho nút tìm kiếm

  function handleKeyUp(event) {
    clearTimeout(timeoutId); // Xóa timeout hiện tại nếu có

    // Kiểm tra phím nhấn là Enter (keyCode = 13)
    if (event.keyCode === 13) {
      // Nếu người dùng nhấn Enter, gọi hàm searchPhotos()
      searchPhotos();
    } else {
      // Nếu không phải Enter, đặt timeout mới sau 500ms và gọi hàm searchSuggestions()
      timeoutId = setTimeout(searchSuggestions, 500);
    }
  }
}
async function searchSuggestions() {
  const searchInput = document.querySelector("#search_img");
  const query = searchInput.value.trim(); // Lấy giá trị từ input và xóa các khoảng trắng thừa

  if (query === "") {
    // Không gọi API nếu không có giá trị nhập vào
    return;
  }

  const apiUrl = buildApiUrl(query); // Xây dựng URL API từ query

  try {
    // Gửi yêu cầu GET đến API Unsplash và chờ kết quả trả về
    const data = await fetchData(apiUrl);

    // Xử lý kết quả từ API và hiển thị gợi ý
    displaySuggestions(data.results);
  } catch (error) {
    console.error("Đã xảy ra lỗi:", error);
  }
}

function buildApiUrl(query) {
  const encodedQuery = encodeURIComponent(query); // Điều chỉnh tham số cho phù hợp với URL
  // Xây dựng URL API với query và các tham số khác
  return `https://api.unsplash.com/search/photos?client_id=UVtAwJGs5CdLjXg5anu1BJEJJKKF2w8YjsuNIb4uCtg&query=${encodedQuery}&page=1&per_page=6&orientation=landscape`;
}

async function fetchData(apiUrl) {
  // Gửi yêu cầu GET đến URL API và trả về kết quả dưới dạng JSON
  const response = await fetch(apiUrl);
  return response.json();
}

function displaySuggestions(results) {
  const resultContainer = document.querySelector(".block_valueImg");

  resultContainer.innerHTML = ""; // Xóa các kết quả gợi ý hiện tại

  // Hiển thị các kết quả gợi ý
  results.forEach((result) => {
    const suggestion = document.createElement("p");
    suggestion.setAttribute("class", "suggestionsearch");
    suggestion.textContent = result.alt_description;
    resultContainer.appendChild(suggestion);
  });
  // tìm kiếm hình ảnh khi click vô text của kết quả trả về
  const textresutls = document.querySelectorAll(".suggestionsearch");
  textresutls.forEach((item) => {
    item.addEventListener("click", searchPhotos);
  });
}

function searchPhotos() {
  const searchInput = document.querySelector("#search_img");
  const query = searchInput.value.trim(); // Lấy giá trị từ input và xóa các khoảng trắng thừa

  if (query === "") {
    // Không gọi API nếu không có giá trị nhập vào
    return;
  }

  const apiUrl = buildApiUrl(query); // Xây dựng URL API từ query

  fetchData(apiUrl)
    .then((data) => {
      // Xử lý kết quả từ API và hiển thị kết quả
      displayResults(data.results);
      //reset input
    })
    .catch((error) => {
      console.error("Đã xảy ra lỗi:", error);
    });
  showControllPage(); //show menu controll
  nextAndPrevPage(query); //gọi hàm controll page images
  numItemImgInPage(query); //gọi hàm controll num images
}

function displayResults(results) {
  const resultContainer = document.querySelector(".block_valueImg");
  resultContainer.innerHTML = ""; // Xóa value hiện tại trong block result

  // Hiển thị các kết quả
  let arrresult = [];
  results.forEach((result, index) => {
    const imgsrc = result.urls.regular;
    let key = `url`;
    let objresult = {
      [key]: imgsrc,
    };
    arrresult.push(objresult);
  });
  loadImgInBrowser(arrresult);
  getDataAjaxRequest(arrresult);
}

function loadImgInBrowser(data) {
  const blockResultImg = document.querySelector(".block_searchImg");
  //Object.values(item)[0] lấy ra value đầu tiên trong obj
  let htmls = data.map((item, index) => {
    return `
    <div class="container_img col l-4 ls-4 m-4">
      <div class="container_img--option">
        <img src="${Object.values(item)[0]}" alt="" class="imgSearch" />
        <div class="container_option">
          <a href="#">PERFECT</a>
          <p>Theo Rue Rouji</p>
        </div>
        <div class="dowload_img">
          <i class="fa-solid fa-cloud-arrow-down"></i>
        </div>
      </div>
    </div>
    
    `;
  });
  blockResultImg.innerHTML = htmls.join("");
}

function getDataAjaxRequest(data) {
  console.log(data);
  $.ajax({
    url: "/task06MVC/public/getDataSearch",
    type: "POST",
    data: {
      urlImg: data,
    },
    success: function (response) {
      if (response.success == "success") {
        console.log(response.message);
      }
    },
    error: function (err) {
      console.log(err);
    },
  });
}

function handleClickIcondowloadImage() {
  const blockimg = document.querySelectorAll(".container_img--option");
  for (let i = 0; i < blockimg.length; i++) {
    const tagImg = blockimg[i].querySelector("img");
    const iconDownload = blockimg[i].querySelector(".dowload_img");

    // Xử lý sự kiện khi nhấp vào biểu tượng tải xuống
    iconDownload.addEventListener("click", () => {
      const urlimg = tagImg.getAttribute("src");

      // Tải nội dung ảnh dưới dạng Blob
      fetch(urlimg)
        .then((response) => response.blob())
        // đối tượng dữ liệu nhị phân

        .then((blob) => {
          const a = document.createElement("a");
          //tạo một URL tạm thời từ đối tượng Blob để sử dụng làm đường dẫn tải xuống.
          const url = URL.createObjectURL(blob);
          //gán đường dẫn URL tạm thời vào thuộc tính href của thẻ <a>,
          //từ đó trình duyệt biết rằng liên kết này sẽ dẫn đến tệp tin được tải xuống.
          a.href = url;
          a.download = "image.jpg"; // Đặt tên tệp ảnh tải xuống
          a.click();

          //  sau khi tải xuống hoàn tất, chúng ta gỡ bỏ URL tạm thời để giải phóng tài nguyên.
          URL.revokeObjectURL(url);
        });
    });
  }
}

let currentIndexPage = 1;
let currentIndexNum = 6;

function nextAndPrevPage(query) {
  const btnNext = document.querySelector(".next");
  const btnPre = document.querySelector(".pre");
  const currrentpage = document.querySelector(".currentPage");
  btnNext.addEventListener("click", () => {
    currentIndexPage++;

    currrentpage.textContent = `Page ${currentIndexPage}`;
    if (query === "") {
      return;
    } else {
      const apinext = buildApiUrlPage(query, currentIndexPage);
      console.log(apinext);
      fetchData(apinext)
        .then((data) => {
          // Xử lý kết quả từ API và hiển thị kết quả
          displayResults(data.results);
          //reset input
        })
        .catch((error) => {
          console.error("Đã xảy ra lỗi:", error);
        });
    }
  });
  btnPre.addEventListener("click", () => {
    if (currentIndexPage > 1) {
      currentIndexPage--;
      currrentpage.textContent = `Page ${currentIndexPage}`;
      if (query === "") {
        return;
      } else {
        const apinext = buildApiUrlPage(query, currentIndexPage);
        console.log(apinext);
        fetchData(apinext)
          .then((data) => {
            // Xử lý kết quả từ API và hiển thị kết quả
            displayResults(data.results);
            //reset input
          })
          .catch((error) => {
            console.error("Đã xảy ra lỗi:", error);
          });
      }
    }
  });
}

function numItemImgInPage(query) {
  const btnInr = document.querySelector(".inrPage");
  const btnDer = document.querySelector(".derPage");
  const currrentpage = document.querySelector(".currentNumImage");
  btnInr.addEventListener("click", () => {
    currentIndexNum++;
    currrentpage.textContent = `${currentIndexNum} Image`;
    if (query === "") {
      return;
    } else {
      const apiNumInr = buildApiUrlNumPage(query, currentIndexNum);
      console.log(apiNumInr);
      fetchData(apiNumInr)
        .then((data) => {
          // Xử lý kết quả từ API và hiển thị kết quả
          displayResults(data.results);
          //reset input
        })
        .catch((error) => {
          console.error("Đã xảy ra lỗi:", error);
        });
    }
  });
  btnDer.addEventListener("click", () => {
    if (currentIndexNum > 6) {
      currentIndexNum--;
      currrentpage.textContent = `${currentIndexNum} Image`;
      if (query === "") {
        return;
      } else {
        const apiNumder = buildApiUrlNumPage(query, currentIndexNum);
        fetchData(apiNumder)
          .then((data) => {
            // Xử lý kết quả từ API và hiển thị kết quả
            displayResults(data.results);
            //reset input
          })
          .catch((error) => {
            console.error("Đã xảy ra lỗi:", error);
          });
      }
    }
  });
}

function buildApiUrlPage(query, currentIndexPage) {
  const encodedQuery = encodeURIComponent(query); // Điều chỉnh tham số cho phù hợp với URL
  const encodedcurrentIndexPage = encodeURIComponent(currentIndexPage); // Điều chỉnh tham số cho phù hợp với URL
  const encodedcurrentIndexNumImg = encodeURIComponent(currentIndexNum); // Điều chỉnh tham số cho phù hợp với URL
  // Xây dựng URL API với query và các tham số khác
  return `https://api.unsplash.com/search/photos?client_id=UVtAwJGs5CdLjXg5anu1BJEJJKKF2w8YjsuNIb4uCtg&query=${encodedQuery}&page=${encodedcurrentIndexPage}&per_page=${encodedcurrentIndexNumImg}&orientation=landscape`;
}

function buildApiUrlNumPage(query, currentIndexNumImg) {
  const encodedQuery = encodeURIComponent(query); // Điều chỉnh tham số cho phù hợp với URL
  const encodedcurrentIndexPage = encodeURIComponent(currentIndexPage); // Điều chỉnh tham số cho phù hợp với URL
  const encodedcurrentIndexNumImg = encodeURIComponent(currentIndexNumImg); // Điều chỉnh tham số cho phù hợp với URL
  // Xây dựng URL API với query và các tham số khác
  return `https://api.unsplash.com/search/photos?client_id=UVtAwJGs5CdLjXg5anu1BJEJJKKF2w8YjsuNIb4uCtg&query=${encodedQuery}&page=${encodedcurrentIndexPage}&per_page=${encodedcurrentIndexNumImg}&orientation=landscape`;
}

function showControllPage() {
  const blockControllPage = document.querySelector(".nextandprepage");
  if (blockControllPage.classList.contains("closed")) {
    // Nếu có, xóa thuộc tính ".closed"
    console.log(oki);
    blockControllPage.classList.remove("closed");
  }
}
