@props(['candidate' => $candidate, 'election' => $election])

<div class="flex justify-between items-center hover:bg-neutral-100 py-3 px-4 rounded-2xl">
    <div class="flex justify-center items-center gap-3">
        <div class="overflow-hidden rounded-full">
            <a href="#" class="w-fit h-fit overflow-hidden">
                <img src="{{ asset('images/profile.jpg') }}" alt="profile picture"
                    class="rounded-full md:h-20 md:w-20 md:min-h-[80px] md:min-w-[80px] md:max-h-[80px] md:max-w-[80px] h-16 w-16 min-h-[64px] min-w-[64px] max-h-[64px] max-w-[64px]"
                    title="View Profile" />
            </a>
        </div>

        <div class="flex flex-col justify-start text-black items-start">
            <h2 class="text-base font-bold uppercase hover:underline" title="View Profile">
                <a href="#">{{ $candidate->name }}</a>
            </h2>
            <p class="text-sm font-light capitalize">{{ $candidate->party }}</p>
        </div>
    </div>

    <div>
        <form action="{{ route('elections.vote', [$election->id, $candidate->id]) }}" method="post"
            class="w-fit h-fit">
            @csrf

            <button type="submit" class="text-neutral-400 hover:text-neutral-700 transition duration-300"
                title="Vote">
                <svg class="h-6 w-6" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M19.946 11.1661L19.967 11.2178L19.99 11.3013L20 11.3847V16.8228C19.9999 16.9743 19.934 17.1207 19.8145 17.2347C19.6949 17.3488 19.5299 17.4227 19.35 17.4429L19.25 17.4488H0.750037C0.568791 17.4488 0.393678 17.394 0.257082 17.2946C0.120487 17.1952 0.0316499 17.0578 0.00700032 16.908L0 16.8228V11.3981L0.00200019 11.3547L0.0120007 11.2829C0.0221506 11.2391 0.0379082 11.1962 0.059003 11.1552L2.81914 6.13187C2.8712 6.03691 2.95091 5.95432 3.05099 5.89164C3.15108 5.82896 3.26836 5.78818 3.39217 5.773L3.50017 5.76716L6.0403 5.76632L5.25026 6.9097L5.18326 7.01819H3.9802L1.9181 10.7721H18.0709L16.0438 7.14505L16.9058 5.89568C16.9728 5.93741 17.0309 5.98999 17.0779 6.04924L17.1309 6.12853L19.946 11.1661ZM11.3656 0.803908L11.4576 0.841464L16.6458 3.34771C16.9738 3.50628 17.1039 3.84094 16.9648 4.12637L16.9198 4.20315L14.1127 8.26839H15.2508C15.4421 8.26677 15.627 8.32627 15.7676 8.4347C15.9081 8.54314 15.9936 8.6923 16.0067 8.85166C16.0197 9.01102 15.9593 9.1685 15.8377 9.29187C15.7161 9.41524 15.5426 9.49516 15.3528 9.51526L15.2508 9.5211L13.2487 9.52026V9.52277H9.16946L9.16646 9.52026H4.75024C4.56139 9.51879 4.38017 9.45791 4.24275 9.3498C4.10534 9.24168 4.02186 9.09429 4.00897 8.93705C3.99609 8.77981 4.05476 8.6243 4.17327 8.50159C4.29177 8.37887 4.46138 8.29798 4.64823 8.27507L4.75024 8.26923L6.57333 8.26839L6.39132 8.18076C6.23485 8.10467 6.11654 7.98402 6.05812 7.84098C5.9997 7.69793 6.00509 7.54209 6.0733 7.4021L6.11731 7.32532L10.4345 1.0693C10.6245 0.794728 11.0246 0.685398 11.3656 0.802239V0.803908ZM11.3556 2.23939L7.78939 7.40877L9.56748 8.26839H12.3846L15.2498 4.11803L11.3576 2.23772L11.3556 2.23939Z"
                        fill="currentColor" />
                </svg>
            </button>
        </form>
    </div>
</div>
