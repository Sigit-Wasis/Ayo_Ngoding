Usage with PSR 7 Streams
===============

PSR-7 streams are `standardized streams <https://www.php-fig.org/psr/psr-7/>`_.

ZipStream-PHP supports working with these streams with the function
``addFileFromPsr7Stream``. 

For all parameters of the function see the API documentation.

Example
---------------

.. code-block:: php
<<<<<<< HEAD
    
    $stream = $response->getBody();
    // add a file named 'streamfile.txt' from the content of the stream
    $zip->addFileFromPsr7Stream('streamfile.txt', $stream);
=======

    $stream = $response->getBody();
    // add a file named 'streamfile.txt' from the content of the stream
    $zip->addFileFromPsr7Stream(
        fileName: 'streamfile.txt',
        stream: $stream,
    );
>>>>>>> 34d8e98f63b8b75b3996f5a00da830531ffbe070
