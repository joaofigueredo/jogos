<?php

test('the application returns a successful response', function () {
    $response = $this->get('/home');

    // $response->assertStatus(200);

    $response->assertSee('Jogos');
});
