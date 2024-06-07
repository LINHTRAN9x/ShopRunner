

@extends('front.layout.master')
@section("body")
    <script>
        var botmanWidget = {
            frameEndpoint: '/botman/chat',
            title: 'My Chatbot',
            introMessage: "✋ Hi! I'm a BotMan chatbot",
            placeholderText: 'Send a message...',
            bubbleAvatarUrl: 'public/front/img/mini-logo-2.svg',
            aboutText: 'BotMan by OpenAI',
            chatServer: '/botman',
            userId: '12345'
        };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
@endsection
