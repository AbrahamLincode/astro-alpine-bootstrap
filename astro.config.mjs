import { defineConfig } from 'astro/config';

export default defineConfig({

    webDependencies: {
      bootstrap: {
        // bootstrap modülünün yolunu buraya yazın
        package: 'bootstrap/dist/css/bootstrap.min.css'
      }
    }

});