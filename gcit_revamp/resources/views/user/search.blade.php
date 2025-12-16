@extends('layout.app')

@section('title', 'Home')

@section('content')

    <div class="">
        <div class="searchHeader">
            <div class="searchHeaderContent">
                <h2 id="resultCount">Showing 0 results for:</h2>
                <h1 id="searchQuery">—</h1>
            </div>
            <div class="searchPageBar">
                <input type="text" id="searchPageInput" placeholder="Search..." />
                <span class="material-symbols-outlined searchIcon">search</span>
            </div>
        </div>

        <div class="searchResultWrapper">
            <div class="searchResult">
                <div class="searchBoxContainer" id="searchResults">
                    <!-- Results injected here -->
                </div>
            </div>
        </div>
    </div>
<script>
const input = document.getElementById('searchPageInput');
const resultsContainer = document.getElementById('searchResults');
const countEl = document.getElementById('resultCount');
const queryEl = document.getElementById('searchQuery');

const params = new URLSearchParams(window.location.search);
let query = params.get('q') || '';

input.value = query;
queryEl.textContent = query;

if (query.length >= 2) {
    fetchResults(query);
}

input.addEventListener('input', debounce(e => {
    const q = e.target.value.trim();
    if (q.length < 2) return;
    updateURL(q);
    fetchResults(q);
}, 300));

function fetchResults(q) {
    fetch(`/api/search?q=${encodeURIComponent(q)}`)
        .then(res => res.json())
        .then(data => renderResults(data));
}

function renderResults(data) {
    resultsContainer.innerHTML = '';

    countEl.textContent = `Showing ${data.count} results for:`;
    queryEl.textContent = data.query;

    if (data.results.length === 0) {
        resultsContainer.innerHTML = `
            <div class="notFoundBox">
                No search results found
            </div>`;
        return;
    }

    data.results.forEach(item => {
        const url = getViewUrl(item);
        resultsContainer.innerHTML += `
            <div class="resultBox">
                <p class="page">${capitalize(item.type)}</p>
                <h1>${item.title}</h1>
                <p class="searchDescription">${item.snippet}</p>
                <a href="${url}" class="searchLink">
                    View More <span class="material-symbols-outlined">keyboard_arrow_right</span>
                </a>
            </div>
        `;
    });
}

function updateURL(q) {
    const newUrl = `${window.location.pathname}?q=${encodeURIComponent(q)}`;
    history.replaceState(null, '', newUrl);
}

function debounce(fn, delay) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), delay);
    };
}

function getViewUrl(item) {
    switch (item.type) {
        case 'course':
            return `/courseDetails/${item.id}`;
        case 'project':
            return `/post/project/${item.id}`;
        case 'event':
            return `/post/events/${item.id}`;
        case 'announcement':
            return `/post/announcement/${item.id}`;
        default:
            return '#';
    }
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}
</script>

@endsection
