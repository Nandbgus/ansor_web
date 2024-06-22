document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const contentGrid = document.getElementById('contentGrid');
    const pagination = document.querySelector('.pagination');
    const blogApp = document.getElementById('blogApp');
    let currentPage = parseInt(blogApp.getAttribute('data-current-page'));
    let totalPages = parseInt(blogApp.getAttribute('data-total-pages'));
    let allBlogs = [];
    const itemsPerPage = 6;

    function filterBlogs(blogs) {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const selectedCategory = categoryFilter.value.trim().toLowerCase();

        contentGrid.innerHTML = '';

        const filteredBlogs = blogs.filter(blog => {
            const title = blog.judul.toLowerCase();
            const categories = blog.kategories.map(kat => kat.nama_kategori.toLowerCase());
            const titleMatch = title.includes(searchTerm);
            const categoryMatch = selectedCategory === '' || categories.includes(selectedCategory);
            return titleMatch && categoryMatch;
        });

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const displayBlogs = filteredBlogs.slice(startIndex, endIndex);

        displayBlogs.forEach(blog => {
            const blogItem = createBlogItem(blog);
            contentGrid.appendChild(blogItem);
        });

        totalPages = Math.ceil(filteredBlogs.length / itemsPerPage);
        updatePagination(currentPage, totalPages);
    }

    function createBlogItem(blog) {
        const div = document.createElement('div');
        div.className = 'konten p-6 rounded-lg shadow-md border tracking-normal bg-white blog-item';
        div.setAttribute('data-title', blog.judul);
        div.setAttribute('data-categories', JSON.stringify(blog.kategories));

       div.innerHTML = `
    <a href="/ansor/public/blog/detail_blog?id=${blog.id_blog}" class="hover:underline">
        <h2 class="text-xl md:text-2xl font-bold mb-4">${blog.judul}</h2>
    </a>
    <p class="text-gray-600 text-sm mb-4">Ditulis oleh <span class="font-semibold text-blue-700">${blog.nama_a}</span> | <span class="font-semibold">${blog.time_stamp}</span></p>
    <div class="foto relative" style="background-image: url('/ansor/public/img/blog/${blog.foto_blogs}'); background-size: cover; background-position: center; width: 100%; height: 200px;">
        <div class="absolute bottom-0 right-0 mb-4">
            ${blog.kategories.map(kategori => `
                <span class="mr-2 mb-2 px-2 py-1 bg-blue-500 text-white rounded text-sm"># ${kategori.nama_kategori}</span>
            `).join('')}
        </div>
    </div>
    <p class="text-gray-700 truncate line-clamp-2">${blog.body}</p>
`;


        return div;
    }

    function fetchAllBlogs() {
        const fetchPromises = [];
        for (let page = 1; page <= totalPages; page++) {
            const url = `http://localhost:8080/ansor/public/blog/index?page=${page}`;

            fetchPromises.push(
                fetch(url, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
            );
        }

        return Promise.all(fetchPromises)
            .then(results => {
                allBlogs = results.reduce((acc, data) => acc.concat(data.isi), []);
                filterBlogs(allBlogs);
            })
            .catch(error => console.error('Error fetching blogs:', error));
    }

    function searchAndUpdate(page = 1) {
        if (page < 1 || page > totalPages) {
            console.error('Invalid page number:', page);
            return;
        }

        currentPage = page;
        filterBlogs(allBlogs);
    }

    function updatePagination(currentPage, totalPages) {
        pagination.innerHTML = '';

        if (currentPage > 1) {
            const prevLink = document.createElement('a');
            prevLink.href = '#';
            prevLink.innerText = 'Previous';
            prevLink.className = 'pagination-prev px-3 py-1 bg-gray-200 border border-gray-300 text-gray-700 rounded-md mr-2 hover:bg-gray-300';
            prevLink.addEventListener('click', function (e) {
                searchAndUpdate(currentPage - 1);
            });
            pagination.appendChild(prevLink);
        }

        for (let i = 1; i <= totalPages; i++) {
            if (i === currentPage) {
                const span = document.createElement('span');
                span.innerText = i;
                span.className = 'pagination-page px-3 py-1 bg-blue-500 text-white border border-blue-500 rounded-md mr-2';
                pagination.appendChild(span);
            } else {
                const pageLink = document.createElement('a');
                pageLink.href = '#';
                pageLink.innerText = i;
                pageLink.className = 'pagination-page px-3 py-1 bg-blue-200 text-blue-700 border border-blue-500 rounded-md mr-2 hover:bg-blue-300';
                pageLink.addEventListener('click', function (e) {
                    searchAndUpdate(i);
                });
                pagination.appendChild(pageLink);
            }
        }

        if (currentPage < totalPages) {
            const nextLink = document.createElement('a');
            nextLink.href = '#';
            nextLink.innerText = 'Next';
            nextLink.className = 'pagination-next px-3 py-1 bg-gray-200 border border-gray-300 text-gray-700 rounded-md mr-2 hover:bg-gray-300';
            nextLink.addEventListener('click', function (e) {
                searchAndUpdate(currentPage + 1);
            });
            pagination.appendChild(nextLink);
        }
    }

    searchInput.addEventListener('input', function () {
        currentPage = 1;
        filterBlogs(allBlogs);
    });

    categoryFilter.addEventListener('change', function () {
        currentPage = 1;
        filterBlogs(allBlogs);
    });

    fetchAllBlogs(); // Inisialisasi filter saat halaman dimuat
});
