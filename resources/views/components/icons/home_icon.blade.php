@props(['class' => $class, 'style' => $style])

<svg style="{{ $style }}" class="{{ $class }}" viewBox="0 0 20 22" fill="none"
    xmlns="http://www.w3.org/2000/svg">
    <path
        d="M1 8L10 1L19 8V19C19 19.5304 18.7893 20.0391 18.4142 20.4142C18.0391 20.7893 17.5304 21 17 21H3C2.46957 21 1.96086 20.7893 1.58579 20.4142C1.21071 20.0391 1 19.5304 1 19V8Z"
        fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
    <mask id="path-2-outside-1_18_44" maskUnits="userSpaceOnUse" x="5" y="10" width="10"
        height="12" fill="black">
        <rect fill="white" x="5" y="10" width="10" height="12" />
        <path d="M7 22V12H13V22" />
    </mask>
    <path
        d="M7 12V10C5.89543 10 5 10.8954 5 12H7ZM13 12H15C15 10.8954 14.1046 10 13 10V12ZM9 22V12H5V22H9ZM7 14H13V10H7V14ZM11 12V22H15V12H11Z"
        fill="#F5F5F5" mask="url(#path-2-outside-1_18_44)" />
</svg>
