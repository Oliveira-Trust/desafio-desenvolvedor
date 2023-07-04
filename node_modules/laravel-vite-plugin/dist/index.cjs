"use strict";
var __create = Object.create;
var __defProp = Object.defineProperty;
var __getOwnPropDesc = Object.getOwnPropertyDescriptor;
var __getOwnPropNames = Object.getOwnPropertyNames;
var __getProtoOf = Object.getPrototypeOf;
var __hasOwnProp = Object.prototype.hasOwnProperty;
var __export = (target, all) => {
  for (var name in all)
    __defProp(target, name, { get: all[name], enumerable: true });
};
var __copyProps = (to, from, except, desc) => {
  if (from && typeof from === "object" || typeof from === "function") {
    for (let key of __getOwnPropNames(from))
      if (!__hasOwnProp.call(to, key) && key !== except)
        __defProp(to, key, { get: () => from[key], enumerable: !(desc = __getOwnPropDesc(from, key)) || desc.enumerable });
  }
  return to;
};
var __toESM = (mod, isNodeMode, target) => (target = mod != null ? __create(__getProtoOf(mod)) : {}, __copyProps(
  isNodeMode || !mod || !mod.__esModule ? __defProp(target, "default", { value: mod, enumerable: true }) : target,
  mod
));
var __toCommonJS = (mod) => __copyProps(__defProp({}, "__esModule", { value: true }), mod);
var src_exports = {};
__export(src_exports, {
  default: () => laravel,
  refreshPaths: () => refreshPaths
});
module.exports = __toCommonJS(src_exports);
var import_meta_url = typeof document === "undefined" ? new (require("url".replace("", ""))).URL("file:" + __filename).href : document.currentScript && document.currentScript.src || new URL("main.js", document.baseURI).href;
var import_fs = __toESM(require("fs"));
var import_os = __toESM(require("os"));
var import_url = require("url");
var import_path = __toESM(require("path"));
var import_picocolors = __toESM(require("picocolors"));
var import_vite = require("vite");
var import_vite_plugin_full_reload = __toESM(require("vite-plugin-full-reload"));
let exitHandlersBound = false;
const refreshPaths = [
  "app/View/Components/**",
  "resources/views/**",
  "resources/lang/**",
  "lang/**",
  "routes/**"
];
function laravel(config) {
  const pluginConfig = resolvePluginConfig(config);
  return [
    resolveLaravelPlugin(pluginConfig),
    ...resolveFullReloadConfig(pluginConfig)
  ];
}
function resolveLaravelPlugin(pluginConfig) {
  let viteDevServerUrl;
  let resolvedConfig;
  const defaultAliases = {
    "@": "/resources/js"
  };
  return {
    name: "laravel",
    enforce: "post",
    config: (userConfig, { command, mode }) => {
      const ssr = !!userConfig.build?.ssr;
      const env = (0, import_vite.loadEnv)(mode, userConfig.envDir || process.cwd(), "");
      const assetUrl = env.ASSET_URL ?? "";
      const serverConfig = command === "serve" ? resolveValetServerConfig(pluginConfig.valetTls) ?? resolveEnvironmentServerConfig(env) : void 0;
      ensureCommandShouldRunInEnvironment(command, env);
      return {
        base: userConfig.base ?? (command === "build" ? resolveBase(pluginConfig, assetUrl) : ""),
        publicDir: userConfig.publicDir ?? false,
        build: {
          manifest: userConfig.build?.manifest ?? !ssr,
          outDir: userConfig.build?.outDir ?? resolveOutDir(pluginConfig, ssr),
          rollupOptions: {
            input: userConfig.build?.rollupOptions?.input ?? resolveInput(pluginConfig, ssr)
          },
          assetsInlineLimit: userConfig.build?.assetsInlineLimit ?? 0
        },
        server: {
          origin: userConfig.server?.origin ?? "__laravel_vite_placeholder__",
          ...process.env.LARAVEL_SAIL ? {
            host: userConfig.server?.host ?? "0.0.0.0",
            port: userConfig.server?.port ?? (env.VITE_PORT ? parseInt(env.VITE_PORT) : 5173),
            strictPort: userConfig.server?.strictPort ?? true
          } : void 0,
          ...serverConfig ? {
            host: userConfig.server?.host ?? serverConfig.host,
            hmr: userConfig.server?.hmr === false ? false : {
              ...serverConfig.hmr,
              ...userConfig.server?.hmr === true ? {} : userConfig.server?.hmr
            },
            https: userConfig.server?.https === false ? false : {
              ...serverConfig.https,
              ...userConfig.server?.https === true ? {} : userConfig.server?.https
            }
          } : void 0
        },
        resolve: {
          alias: Array.isArray(userConfig.resolve?.alias) ? [
            ...userConfig.resolve?.alias ?? [],
            ...Object.keys(defaultAliases).map((alias) => ({
              find: alias,
              replacement: defaultAliases[alias]
            }))
          ] : {
            ...defaultAliases,
            ...userConfig.resolve?.alias
          }
        },
        ssr: {
          noExternal: noExternalInertiaHelpers(userConfig)
        }
      };
    },
    configResolved(config) {
      resolvedConfig = config;
    },
    transform(code) {
      if (resolvedConfig.command === "serve") {
        code = code.replace(/__laravel_vite_placeholder__/g, viteDevServerUrl);
        return pluginConfig.transformOnServe(code, viteDevServerUrl);
      }
    },
    configureServer(server) {
      const envDir = resolvedConfig.envDir || process.cwd();
      const appUrl = (0, import_vite.loadEnv)(resolvedConfig.mode, envDir, "APP_URL").APP_URL ?? "undefined";
      server.httpServer?.once("listening", () => {
        const address = server.httpServer?.address();
        const isAddressInfo = (x) => typeof x === "object";
        if (isAddressInfo(address)) {
          viteDevServerUrl = resolveDevServerUrl(address, server.config);
          import_fs.default.writeFileSync(pluginConfig.hotFile, viteDevServerUrl);
          setTimeout(() => {
            server.config.logger.info(`
  ${import_picocolors.default.red(`${import_picocolors.default.bold("LARAVEL")} ${laravelVersion()}`)}  ${import_picocolors.default.dim("plugin")} ${import_picocolors.default.bold(`v${pluginVersion()}`)}`);
            server.config.logger.info("");
            server.config.logger.info(`  ${import_picocolors.default.green("\u279C")}  ${import_picocolors.default.bold("APP_URL")}: ${import_picocolors.default.cyan(appUrl.replace(/:(\d+)/, (_, port) => `:${import_picocolors.default.bold(port)}`))}`);
          }, 100);
        }
      });
      if (!exitHandlersBound) {
        const clean = () => {
          if (import_fs.default.existsSync(pluginConfig.hotFile)) {
            import_fs.default.rmSync(pluginConfig.hotFile);
          }
        };
        process.on("exit", clean);
        process.on("SIGINT", process.exit);
        process.on("SIGTERM", process.exit);
        process.on("SIGHUP", process.exit);
        exitHandlersBound = true;
      }
      return () => server.middlewares.use((req, res, next) => {
        if (req.url === "/index.html") {
          res.statusCode = 404;
          res.end(
            import_fs.default.readFileSync(import_path.default.join(dirname(), "dev-server-index.html")).toString().replace(/{{ APP_URL }}/g, appUrl)
          );
        }
        next();
      });
    }
  };
}
function ensureCommandShouldRunInEnvironment(command, env) {
  if (command === "build" || env.LARAVEL_BYPASS_ENV_CHECK === "1") {
    return;
  }
  if (typeof env.LARAVEL_VAPOR !== "undefined") {
    throw Error("You should not run the Vite HMR server on Vapor. You should build your assets for production instead. To disable this ENV check you may set LARAVEL_BYPASS_ENV_CHECK=1");
  }
  if (typeof env.LARAVEL_FORGE !== "undefined") {
    throw Error("You should not run the Vite HMR server in your Forge deployment script. You should build your assets for production instead. To disable this ENV check you may set LARAVEL_BYPASS_ENV_CHECK=1");
  }
  if (typeof env.LARAVEL_ENVOYER !== "undefined") {
    throw Error("You should not run the Vite HMR server in your Envoyer hook. You should build your assets for production instead. To disable this ENV check you may set LARAVEL_BYPASS_ENV_CHECK=1");
  }
  if (typeof env.CI !== "undefined") {
    throw Error("You should not run the Vite HMR server in CI environments. You should build your assets for production instead. To disable this ENV check you may set LARAVEL_BYPASS_ENV_CHECK=1");
  }
}
function laravelVersion() {
  try {
    const composer = JSON.parse(import_fs.default.readFileSync("composer.lock").toString());
    return composer.packages?.find((composerPackage) => composerPackage.name === "laravel/framework")?.version ?? "";
  } catch {
    return "";
  }
}
function pluginVersion() {
  try {
    return JSON.parse(import_fs.default.readFileSync(import_path.default.join(dirname(), "../package.json")).toString())?.version;
  } catch {
    return "";
  }
}
function resolvePluginConfig(config) {
  if (typeof config === "undefined") {
    throw new Error("laravel-vite-plugin: missing configuration.");
  }
  if (typeof config === "string" || Array.isArray(config)) {
    config = { input: config, ssr: config };
  }
  if (typeof config.input === "undefined") {
    throw new Error('laravel-vite-plugin: missing configuration for "input".');
  }
  if (typeof config.publicDirectory === "string") {
    config.publicDirectory = config.publicDirectory.trim().replace(/^\/+/, "");
    if (config.publicDirectory === "") {
      throw new Error("laravel-vite-plugin: publicDirectory must be a subdirectory. E.g. 'public'.");
    }
  }
  if (typeof config.buildDirectory === "string") {
    config.buildDirectory = config.buildDirectory.trim().replace(/^\/+/, "").replace(/\/+$/, "");
    if (config.buildDirectory === "") {
      throw new Error("laravel-vite-plugin: buildDirectory must be a subdirectory. E.g. 'build'.");
    }
  }
  if (typeof config.ssrOutputDirectory === "string") {
    config.ssrOutputDirectory = config.ssrOutputDirectory.trim().replace(/^\/+/, "").replace(/\/+$/, "");
  }
  if (config.refresh === true) {
    config.refresh = [{ paths: refreshPaths }];
  }
  return {
    input: config.input,
    publicDirectory: config.publicDirectory ?? "public",
    buildDirectory: config.buildDirectory ?? "build",
    ssr: config.ssr ?? config.input,
    ssrOutputDirectory: config.ssrOutputDirectory ?? "bootstrap/ssr",
    refresh: config.refresh ?? false,
    hotFile: config.hotFile ?? import_path.default.join(config.publicDirectory ?? "public", "hot"),
    valetTls: config.valetTls ?? false,
    transformOnServe: config.transformOnServe ?? ((code) => code)
  };
}
function resolveBase(config, assetUrl) {
  return assetUrl + (!assetUrl.endsWith("/") ? "/" : "") + config.buildDirectory + "/";
}
function resolveInput(config, ssr) {
  if (ssr) {
    return config.ssr;
  }
  return config.input;
}
function resolveOutDir(config, ssr) {
  if (ssr) {
    return config.ssrOutputDirectory;
  }
  return import_path.default.join(config.publicDirectory, config.buildDirectory);
}
function resolveFullReloadConfig({ refresh: config }) {
  if (typeof config === "boolean") {
    return [];
  }
  if (typeof config === "string") {
    config = [{ paths: [config] }];
  }
  if (!Array.isArray(config)) {
    config = [config];
  }
  if (config.some((c) => typeof c === "string")) {
    config = [{ paths: config }];
  }
  return config.flatMap((c) => {
    const plugin = (0, import_vite_plugin_full_reload.default)(c.paths, c.config);
    plugin.__laravel_plugin_config = c;
    return plugin;
  });
}
function resolveDevServerUrl(address, config) {
  const configHmrProtocol = typeof config.server.hmr === "object" ? config.server.hmr.protocol : null;
  const clientProtocol = configHmrProtocol ? configHmrProtocol === "wss" ? "https" : "http" : null;
  const serverProtocol = config.server.https ? "https" : "http";
  const protocol = clientProtocol ?? serverProtocol;
  const configHmrHost = typeof config.server.hmr === "object" ? config.server.hmr.host : null;
  const configHost = typeof config.server.host === "string" ? config.server.host : null;
  const serverAddress = isIpv6(address) ? `[${address.address}]` : address.address;
  const host = configHmrHost ?? configHost ?? serverAddress;
  const configHmrClientPort = typeof config.server.hmr === "object" ? config.server.hmr.clientPort : null;
  const port = configHmrClientPort ?? address.port;
  return `${protocol}://${host}:${port}`;
}
function isIpv6(address) {
  return address.family === "IPv6" || address.family === 6;
}
function noExternalInertiaHelpers(config) {
  const userNoExternal = config.ssr?.noExternal;
  const pluginNoExternal = ["laravel-vite-plugin"];
  if (userNoExternal === true) {
    return true;
  }
  if (typeof userNoExternal === "undefined") {
    return pluginNoExternal;
  }
  return [
    ...Array.isArray(userNoExternal) ? userNoExternal : [userNoExternal],
    ...pluginNoExternal
  ];
}
function resolveEnvironmentServerConfig(env) {
  if (!env.VITE_DEV_SERVER_KEY && !env.VITE_DEV_SERVER_CERT) {
    return;
  }
  if (!import_fs.default.existsSync(env.VITE_DEV_SERVER_KEY) || !import_fs.default.existsSync(env.VITE_DEV_SERVER_CERT)) {
    throw Error(`Unable to find the certificate files specified in your environment. Ensure you have correctly configured VITE_DEV_SERVER_KEY: [${env.VITE_DEV_SERVER_KEY}] and VITE_DEV_SERVER_CERT: [${env.VITE_DEV_SERVER_CERT}].`);
  }
  const host = resolveHostFromEnv(env);
  if (!host) {
    throw Error(`Unable to determine the host from the environment's APP_URL: [${env.APP_URL}].`);
  }
  return {
    hmr: { host },
    host,
    https: {
      key: import_fs.default.readFileSync(env.VITE_DEV_SERVER_KEY),
      cert: import_fs.default.readFileSync(env.VITE_DEV_SERVER_CERT)
    }
  };
}
function resolveHostFromEnv(env) {
  try {
    return new URL(env.APP_URL).host;
  } catch {
    return;
  }
}
function resolveValetServerConfig(host) {
  if (host === false) {
    return;
  }
  host = host === true ? resolveValetHost() : host;
  const keyPath = import_path.default.resolve(import_os.default.homedir(), `.config/valet/Certificates/${host}.key`);
  const certPath = import_path.default.resolve(import_os.default.homedir(), `.config/valet/Certificates/${host}.crt`);
  if (!import_fs.default.existsSync(keyPath) || !import_fs.default.existsSync(certPath)) {
    throw Error(`Unable to find Valet certificate files for your host [${host}]. Ensure you have run "valet secure".`);
  }
  return {
    hmr: { host },
    host,
    https: {
      key: import_fs.default.readFileSync(keyPath),
      cert: import_fs.default.readFileSync(certPath)
    }
  };
}
function resolveValetHost() {
  const configPath = import_os.default.homedir() + `/.config/valet/config.json`;
  if (!import_fs.default.existsSync(configPath)) {
    throw Error("Unable to find the Valet configuration file. You will need to manually specify the host in the `valetTls` configuration option.");
  }
  const config = JSON.parse(import_fs.default.readFileSync(configPath, "utf-8"));
  return import_path.default.basename(process.cwd()) + "." + config.tld;
}
function dirname() {
  return (0, import_url.fileURLToPath)(new URL(".", import_meta_url));
}
// Annotate the CommonJS export names for ESM import in node:
0 && (module.exports = {
  refreshPaths
});
