@if ($paginator->hasPages())
    <nav class="pagination-wrapper" role="navigation">
        <ul class="pagination">
            @if ($paginator->onFirstPage())
                <li class="disabled">
                    <span class="page-link">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">&lsaquo;</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next">&rsaquo;</a>
                </li>
            @else
                <li class="disabled">
                    <span class="page-link">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>

    <style>
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .pagination li {
            display: inline-block;
        }
        .pagination li a,
        .pagination li span {
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            border-radius: 10px;
            background: #fff0f5;
            color: #ff6b9d;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .pagination li a:hover {
            background: #ff6b9d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 107, 157, 0.3);
        }
        .pagination li.active span {
            background: #ff6b9d;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(255, 107, 157, 0.3);
        }
        .pagination li.disabled span {
            opacity: 0.4;
            cursor: not-allowed;
            background: #f0f0f0;
            color: #999;
        }
    </style>
@endif
