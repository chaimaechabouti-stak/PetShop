@if ($paginator->hasPages())
    <nav class="custom-pagination">
        <ul class="pagination-list">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">Précédent</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}">Précédent</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}">Suivant</a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">Suivant</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
    .custom-pagination {
        display: flex;
        justify-content: center;
        margin: 20px 0;
    }

    .pagination-list {
        display: flex;
        list-style: none;
        padding: 0;
        margin: 0;
        gap: 5px;
    }

    .page-item {
        margin: 0;
    }

    .page-link {
        display: block;
        padding: 10px 15px;
        background-color: white;
        border: 1px solid #dee2e6;
        border-radius: 5px;
        color: #4CAF50;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        min-width: 40px;
        text-align: center;
    }

    .page-link:hover {
        background-color: #4CAF50;
        color: white;
        border-color: #4CAF50;
        transform: translateY(-1px);
    }

    .page-item.active .page-link {
        background-color: #4CAF50;
        color: white;
        border-color: #4CAF50;
    }

    .page-item.disabled .page-link {
        background-color: #f8f9fa;
        color: #6c757d;
        cursor: not-allowed;
        border-color: #dee2e6;
    }

    .page-item.disabled .page-link:hover {
        background-color: #f8f9fa;
        color: #6c757d;
        transform: none;
    }
    </style>
@endif