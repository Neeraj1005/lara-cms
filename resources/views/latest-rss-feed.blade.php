<rss xmlns:atom="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" version="2.0">
    <channel>
        <atom:link type="application/rss+xml" rel="self"
            href="{{ route('home.rss') }}" />
        <title>
            {{ __('Latest Post') }}>
        </title>
        <link>{{ config('app.url') }}</link>
        <description>
            {{ __('Latest Post') }}
        </description>
        <copyright>
            Copyright:(C) {{ config('app.name') }} {{ date('Y') }} All Rights Reserved
        </copyright>
        <language>
            {{ __('en-US') }}
        </language>

        <lastBuildDate>{{ $latestPosts ?? $latestPosts->first()->updated_at->toRssString() }}</lastBuildDate>

        @foreach($latestPosts as $post)
            <item>
                <title>{{ $post->title }}</title>
                <description>
                    <![CDATA[{!! $post->summary_of_body !!}]]>
                </description>
                <link>{{ route('home.cms.show',$post->slug) }}</link>
                <guid>{{ route('home.cms.show',$post->slug) }}</guid>
                <pubDate>{{ $post->created_at->toRssString() }}</pubDate>
                <media:content url="{{ asset($post->profileImage()) }}"
                    medium="image" />
            </item>
        @endforeach


    </channel>

</rss>
